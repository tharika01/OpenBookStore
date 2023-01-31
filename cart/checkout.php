<!-- Including connect file-->
<?php
include('../includes/connect.php');
include('../functions/common_fun.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BooksApp using PHP and mysql-checkout page</title>
  <!--bootstrap CSS link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!--font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--css file-->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!--navbar-->
  <div class="container-fluid p-0">
    <!--first child-->
    <nav class="navbar navbar-expand-lg  fixed-top navbar-light" style="height: 50px; background-color:rgba(132, 68,28, 0.8); text-color:#F4DCC4;">
      <div class="container-fluid">
        <img src="images/logo.jpg" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../home/home.php">Home</a>
            </li>
            <!-- Category -->
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Category</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../login/signup.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../donor/index.php">Donate</a>
            </li>
          </ul>
          <ul class="navbar-nav me-auto" style="text-color: white">
            <?php
            //displaying welcome message
            session_start();
            if (!isset($_SESSION['email'])) {
              echo
              "<span class='navbar-text'>
                  <li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                  </li> 
                </span>";
            } else {
              echo
              "<span class='navbar-text'>
                <li class='nav-item'>
                  <a class='nav-link' href='#'>Welcome " . $_SESSION['name'] . "</a>
                </li>
                </span>";
            }
            //login if user not logged in yet , and logout if user has already logged in
            if (!isset($_SESSION['email'])) {
              echo
              "<span class='navbar-text'>
                <li class='nav-item'>
                  <a class='nav-link' href='login.php'>Login</a>
                </li>
                </span>";
            } else {
              echo
              "<span class='navbar-text'>
              <li class='nav-item'>
                <a class='nav-link' href='logout.php'>Logout</a>
              </li>
              </span>";
            }
            ?>

          </ul>
          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_book">
          </form>
        </div>
      </div>
    </nav>

    <div class="row px-1">
      <div class="col-md-12">
        <div class="row">
          <?php
          if (!isset($_SESSION['email'])) {
            echo "<script>window.open('login.php','_self')</script>";
          } else {
            //deleting from cart and from book_delete since the  order is successful
            //trigger used to insert data into orders table since order successful
            $my_ip = getIPAddress();
            $del_cart_query = "delete from `cart_details` where Ip_address = '$my_ip'";
            $delete_book = "delete from `book_delete` where donor_ip = '$my_ip'";
            $result_delete_book = mysqli_query($con, $delete_book);
            $result = mysqli_query($con, $del_cart_query);
            if ($result and $result_delete_book) {
              echo "<script>alert('deleted from cart and books')</script>";
              echo "<script>window.open('successful.php','_self')</script>";
            }
          }
          ?>
        </div>
      </div>
    </div>

  </div>
  <!-- last child
  <div>
    <style>
      footer {
        position: absolute;
        width: 100%;
        bottom: 0;
      }
    </style>
    <?php
    //include('../includes/footer.php');
    ?>
  </div> -->
  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>