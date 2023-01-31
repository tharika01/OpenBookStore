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
    <title>Donor dashboard</title>
    <!--bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- csd file-->
    <link rel="stylesheet" href="../style.css">

</head>

<body style="background-color: #f9f7f6;">
    <!--navbar-->
    <div class="container-fluid p-0">
        <!--First child-->
        <div class="" style="height:400px; background-image:url('../images/donor_bg.jpg');">
            <nav class="navbar navbar-expand-lg navbar-light" style="height: 50px; text-color:#F4DCC4;">
                <div class="container-fluid">
                    <img src="../images/logo.jpg" alt="" class="logo" style="width :80px;">
                    <nav class="navbar navbar-expand-lg ">
                        <ul class="navbar-nav">

                            <?php
                            //displaying welcome message
                            session_start();
                            if (!isset($_SESSION['email'])) {
                                echo
                                "<span class='navbar-text'>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='#' style='color: white; text-decoration: none; font-size: 20px;'>Welcome Guest</a>
                                    </li> 
                                </span>";
                            } else {
                                echo
                                "<span>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='#' style='color: white; text-decoration: none; font-size: 20px;'>Welcome " . $_SESSION['name'] . "</a>
                                    </li>  
                                </span>";
                            }
                            //login if user not logged in yet , and logout if user has already logged in
                            if (!isset($_SESSION['email'])) {
                                echo
                                "<span>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../login/login.php' style='color: black; text-decoration: none; font-size: 20px;'>Login</a>
                                    </li>  
                                </span>";
                            } else {
                                echo
                                "<span>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../login/logout.php' style='color: black; text-decoration: none; font-size: 20px;'>Logout</a>
                                    </li>  
                                </span>";
                            }
                            ?>
                            <li class="nav-item">
                                <a href="../index.php" class="nav-link" style="color: black; text-decoration: none; font-size: 20px;">Home</a>
                            </li>
                        </ul>
                    </nav>
                </div>
        </div>
        <!--third class-->
        <div class="row">
            <div class="col-md-12 d-flex align-items-center" style="background-color:#c4a484">
                <div class="p-4">
                    <a href="#">
                        <!--  -->
                        <?php
                        if (isset($_SESSION['email'])) {
                            $email_id = $_SESSION['email'];
                            //$name = $_SESSION['name'] = $name;
                            $user_image = "select * from `login` where email='$email_id'";
                            $result_image = mysqli_query($con, $user_image);
                            $row_image = mysqli_fetch_array($result_image);
                            $user_fname = $row_image['user_fname'];
                            $user_image = $row_image['user_image'];
                            echo "<img src='../login/profile_photos/$user_image' alt='' class='donor_image'>";
                            echo "<p class='text-center' style='color:#fff;font-size:20px;'>$user_fname</p>";
                        } else {
                            echo "<img src='../images/profile.png' alt='' class='donor_image'>";
                            echo "<p class='text-center' style='color:#000;'>User Name</p>";
                        }
                        ?>
                    </a>

                </div>
                <!--top 10 buttons-->
                <div class="button text-center">
                    <button class="my-3"><a href="index.php?insert_book" class="nav-link text-light btn-secondary border-0">Add Books</a></button>
                    <!-- <button><a href="" class="nav-link text-light btn-secondary my-1">View Books</a></button> -->
                    <button><a href="index.php?insert_category" class="nav-link text-light btn-secondary">Insert book Category</a></button>
                    <!-- <button><a href="" class="nav-link text-light btn-secondary my-1">View Categories</a></button> -->
                    <button><a href="index.php?insert_publisher" class="nav-link text-light btn-secondary">Insert publishers</a></button>
                    <!-- <button><a href="" class="nav-link text-light btn-secondary my-1">View publishers</a></button> -->
                    <!-- <button><a href="" class="nav-link text-light btn-secondary my-1">All orders</a></button>
                    <button><a href="" class="nav-link text-light btn-secondary my-1">All receivers</a></button>
                    <button><a href="" class="nav-link text-light btn-secondary my-1">Logout</a></button> -->

                </div>
            </div>
        </div>
        <!--If needed footer can be added-->

        <!--Fourth child-->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }
            if (isset($_GET['insert_publisher'])) {
                include('insert_publishers.php');
            }
            if (isset($_GET['insert_book'])) {
                include('insert_books.php');
            }
            ?>
        </div>
        <?php
        include("../includes/footer.php")
        ?>
        <!--bootstrap JS link-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>