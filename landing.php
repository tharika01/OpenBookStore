<?php
include('includes/connect.php');
include('functions/common_fun.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book sharing web app</title>
  <link rel="stylesheet" href="css/landing.css" />
</head>

<body>
  <div class="banner">
    <div class="navbar">
      <img src="images/logo.jpg" class="logo" />
      <ul>
        <li><a href="home/home.php">Home</a></li>
        <li><a href="login/login.php">Login</a></li>
        <li><a href="index.php" target="_self">Shop</a></li>
        <li>
          <a href="cart/cart.php" name="go_to_cart">Shopping Bag</a>
          <img src="images/bag.png" class="shop_bag" />
        </li>
      </ul>
    </div>
    <div class="content">
      <h1>
        Sharing is good and with digital <br />
        Technology sharing is easy.
      </h1>
      <p>So share your books and help change the world.</p>
    </div>
  </div>
</body>

</html>
<?php
if (isset($_POST['go_to_cart'])) {
  if (!isset($_SESSION['email'])) {
    //include('./login/login.php');
    echo "<script>window.open('./login/login.php','_self')</script>";
  } else {
    include('successful.php');
    //echo "<script>window.open('successful.php','_self')</script>";
  }
}
?>