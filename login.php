<?php

session_start();

if(isset($_SESSION["pin"])) header("Location: index.php");

if(isset($_POST['pin'])){

    $pin        =   $_POST['pin'];
    $checkpin   =   fread(fopen('.pin','r'),611);
    
    if($pin == $checkpin)
    {                    
        session_start();
        $_SESSION["pin"] = $pin;            
        header("Location: index.php");
    }    
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
            <form action="login.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Insert your pin to unlock.." name="pin">
                    <br>
                    <p align="center">
                        <button type="submit" class="btn btn-success">Unlock !</button>
                    </p>                
                </div>                    
            </form>              
        </div>
    </div>    
</body>
</html>