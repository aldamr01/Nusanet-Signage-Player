<?php
session_start();

if(!isset($_SESSION["pin"]))
    header("Location: login.php");
else
{   
    //session_destroy();
    exec('sudo /sbin/reboot');
    
}
