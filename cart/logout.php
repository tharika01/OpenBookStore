<?php
session_start();
session_unset();
session_destroy();
echo "Variables destroyed";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:bisque;">
    <h1>User logged out</h1>
    <button class='px-3 py-2 border-1 mx-3'><a href='../home/home.php' class='text-decoration-none'>Continue Shopping</a></button>
</body>

</html>