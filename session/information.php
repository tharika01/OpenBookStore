<?php
//get the data stored using session
    session_start();
    if(isset($_SESSION['username'])){
        echo "Welcome".$_SESSION['username'];
        echo "<br>";
        echo "Email is ".$_SESSION['email'];
        echo "<br>";
        echo "Password is ".$_SESSION['password'];
    }
    else
        echo "Please login to continue";
    
?>