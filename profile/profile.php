<!-- Including connect file-->
<?php
include('../includes/connect.php');
include('../functions/common_fun.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css file-->
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--first child-->
        <nav class="navbar navbar-expand-lg  fixed-top navbar-light" style="height: 50px; background-color:rgba(132, 68,28, 0.8); text-color:#F4DCC4;">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Home page link -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../home/home.php">Home</a>
                        </li>

                        <!-- Category menu -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Category</a>
                        </li>
                        <!-- Donor page link -->
                        <li class="nav-item">
                            <a class="nav-link" href="../donor/index.php">Donate<i class="fa fa-heart" aria-hidden="true"></i></a>
                        </li>
                        <!-- Cart page link  -->
                        <li class="nav-item">
                            <a class="nav-link" href="../cart/cart.php">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <sup>
                                    <?php
                                    $select_cart_items = "select * from `cart_details`";
                                    $result_query = mysqli_query($con, $select_cart_items);
                                    $num_items = mysqli_num_rows($result_query);
                                    if ($num_items > 0) {
                                        echo "$num_items";
                                    } else {
                                        echo "0";
                                    }
                                    ?>
                                </sup>
                            </a>
                        </li>


                        <!-- Register page link -->
                        <li class="nav-item">
                            <!-- login if user not logged in yet , and logout if user has already logged in -->
                            <?php
                            if (!isset($_SESSION['email'])) {
                                echo
                                "<span class='navbar-text'>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../login/login.php'>Login</a>
                                    </li>  
                                </span>";
                            } else {
                                echo
                                "<li class='nav-item' style='color: white; list-style: none;'>
                                    <a class='nav-link' href='profile.php'>Profile<i class='fa fa-user' aria-hidden='true'></i></a>
                                </li>";
                            }
                            ?>
                        </li>

                    </ul>
                    <?php
                    //displaying welcome message

                    if (!isset($_SESSION['email'])) {
                        echo
                        "<span>
                                <li class='nav-item' style='color: white; list-style: none;'>
                                    <a class='nav-link' href='#' style='color: white;'>Welcome Guest</a>
                                </li> 
                            </span>";
                    } else {
                        echo
                        "<span>
                            <li class='nav-item' style='color: white; list-style: none;'>
                                <a class='nav-link' href='#' style='color: white;'>Welcome " . $_SESSION['name'] . "</a>
                            </li>  
                        </span>";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </div>
    <div>
    </div>

    <div class="row" style="padding-top: 50px; position:relative; height:100vh">
        <div class="col-md-2 py-10 sidenav">
            <ul class="navbar-nav text-center sidenav-list">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <h5>Your Profile</h5>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['email'])) {
                        $email_id = $_SESSION['email'];
                        //$name = $_SESSION['name'] = $name;
                        $user_image = "select * from `login` where email='$email_id'";
                        $result_image = mysqli_query($con, $user_image);
                        $row_image = mysqli_fetch_array($result_image);
                        $user_fname = $row_image['user_fname'];
                        $user_image = $row_image['user_image'];
                        echo "<img src='../login/profile_photos/$user_image' alt='' class='profile_image text-center'>";
                        echo "<p class='text-center' style='color:#fff;font-size:20px;'>$user_fname</p>";
                    } else {
                        echo "<img src='../images/profile.png' alt='' class='profile_image my-2'>";
                        echo "<p class='text-center' style='color:#000;'>User Name</p>";
                    }
                    ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php?my_details">
                        <h4>My Details</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php?my_orders">
                        <h4>My Orders</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php?my_donations">
                        <h4>My Donations</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php?edit_account">
                        <h4>Edit Account</h4>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile.php?logout">
                        <h4>Logout</h4>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-10 js-remove-this">
            <?php
            if (isset($_GET['my_details'])) {
                include('user_det.php');
            }
            if (isset($_GET['my_orders'])) {
                include('my_orders.php');
            }
            if (isset($_GET['my_donations'])) {
                include('my_donations.php');
            }
            if (isset($_GET['edit_account'])) {
                include('edit_account.php');
            }
            if (isset($_GET['logout'])) {
                echo "<script>window.open('../login/logout.php','_self')</script>";
            }
            ?>
        </div>
    </div>
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>