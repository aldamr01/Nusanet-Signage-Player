<?php

session_start();

if(!isset($_SESSION["pin"])) header("Location: login.php");

if(isset($_POST['change_pin']))
{
    $file   =   fopen(".pin","w");
    $pin    =   $_POST['change_pin'];

    fwrite($file,$pin);
    fclose($file);
    session_destroy();
    header("Location:login.php");
}

if(isset($_POST['change_url']))
{
    $file   =   fopen(".url","w");
    $url    =   $_POST['change_url'];

    fwrite($file,$url);
    fclose($file);

    $file2  = fopen("/etc/xdg/lxsession/LXDE-pi/autostart","w");
    $file3  = fopen("/var/www/html/chromium.sh","w");

    $ip     =   $_POST['change_url'];
$text   ="
@lxpanel --profile LXDE-pi
@pcmanfm --desktop --profile LXDE-pi
#@xscreensaver -no-splash
@point-rpi

# BEGIN ADDED

# Normal website that does not need any exceptions
@/usr/bin/chromium-browser --incognito --start-maximized --kiosk --allow-running-insecure-content --remember-cert-error-decisions  ".$ip."
# Enable mixed http/https content, remember if invalid certs were allowed (ie self signed certs)
#@/usr/bin/chromium-browser --incognito --start-maximized --kiosk --allow-running-insecure-content --remember-cert-error-decisions http://gordonturner.com
@unclutter
@xset s off
@xset s noblank
@xset -dpms

# END ADDED
";

$text2 ="
export DISPLAY=:0;
chromium-browser --incognito --start-maximized --kiosk --allow-running-insecure-content --remember-cert-error-decisions ".$ip."
";

    fwrite($file3,$text2);
    fclose($file3);

    fwrite($file2,$text);
    fclose($file2);

    session_destroy(); 
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Auth</title>
    <style>
        .cent{            
            position:absolute;
            margin:0;  
            top: 50%;
            left: 50%;        
            margin-right: -50%;
            transform: translate(-50%, -50%)
        }
        .cont{
            display: flex;
            align-items: center;
            justify-content: center;
            background:rgba(17, 17, 34, 0.9);
        }

        body{
            margin:0;
            padding:0;
        }
    </style>
</head>
<body>
    <div class="cont">
        <div class="cent"> 
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Option</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form action="index.php" method="post">
                            <td>
                                <input name="change_pin" type="text" value="<?=fread(fopen('.pin','r'),10000)?>"  class="form-control">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-info">Change PIN</button>
                            </td>
                        </form>                        
                    </tr>
                    <tr>
                        <form action="index.php" method="post">
                            <td>
                                <textarea name="change_url" type="text" class="form-control"><?=fread(fopen('.url','r'),10000)?></textarea>
				<p style="color:#b5bcbc">example url : "http://www.google.com" </p>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-warning">Change URL</button>
                            </td>
                        </form>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p align="center">
				<a href="refresh.php" class="btn btn-danger">Submit to Device</a>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>                                           
        </div>
    </div>    
</body>

</html>
