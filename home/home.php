<?php
include("../includes/connect.php");
include("../functions/common_fun.php");
session_start();
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
  <link rel="stylesheet" href="home.css">

</head>

<body style="background-color: #f9f7f6; overflow:none;">
  <!--navbar-->
  <div class="container-fluid p-0">
    <div class="" style="height:400px; background-image:url('../images/donor_bg.jpg');">
      <!--<h3 class="text-center p-2" style="text-color:white;"  >Details</h3>!-->
      <nav class="navbar navbar-expand-lg  fixed-top navbar-light" style="height: 50px; background-color:rgba(132, 68,28, 0.8); text-color:#F4DCC4;">
        <div class="container-fluid">
          <img src="../images/logo.jpg" alt=" " class="logo">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="home.php">Home</a>
              </li>
              <!-- Category menu -->
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Category</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="../cart/cart.php">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                  <sup>
                    <!-- displaying the number of items in cart in superscript -->
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
              <li class="nav-item">
                <?php
                if (!isset($_SESSION['email'])) {
                  echo
                  "<span class='navbar-text'>
                    <li class='nav-item'>
                      <a class='nav-link active' href='../login/login.php'>Login</a>
                    </li>  
                  </span>";
                } else {
                  echo
                  "<li class='nav-item'>
                    <a class='nav-link active' href='../donor/index.php'>Donate<i class='fa-solid fa-heart'></i></a>
                  </li>
                  <li class='nav-item' style='color: white; list-style: none;'>
                    <a class='nav-link active' href='../profile/profile.php'>Profile<i class='fa fa-user' aria-hidden='true'></i></a>
                  </li>
                  <span>
                    <li class='nav-item'>
                      <a class='nav-link' href='../login/logout.php'>Logout</a>
                    </li>  
                  </span>";
                }
                ?>
              </li>
            </ul>
            <ul class="navbar-nav me-auto" style="text-color: white">
              <?php
              //displaying welcome message

              if (!isset($_SESSION['email'])) {
                echo
                "<span class='navbar-text' style='color: white; list-style: none;'>
                  <li class='nav-item'>
                    <a class='nav-link' href='#' style='color: white'>Welcome Guest</a>
                  </li> 
                </span>";
              } else {
                echo
                "<span class='navbar-text'>
                  <li class='nav-item' style='color: white; list-style: none;'>
                    <a class='nav-link' href='#' style='color: white;'>Welcome " . $_SESSION['name'] . "</a>
                  </li>  
                </span>";
              }
              ?>
            </ul>
            <form class="d-flex" action="../search_product.php" method="get">
              <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_data">
              <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_book">
            </form>
            </ul>
          </div>
        </div>
      </nav>
      <div class='content text-center' style="position: relative;">
        <h1>Buy and share books now !</h1>
        <p>Sharing of books made easy</p>
        <div>
          <button type="button border-0" class="button_home"><span class="home"></span><a href="../index.php">Start Shopping</a></button>
          <button type="button border-0" class="button_home"><span class="home"></span><a href="../donor/index.php">Start Sharing</a></button>
        </div>
      </div>
    </div>
  </div>
  <div class="about my-3">
    <h5 class="text-center">About Us</h5>
    <p style="margin: 25px 50px 75px 100px;">
    We believe in making books immortal and making them live forever.
    The books that would waste in someone's house have been reused and given a new life.
    The life span of books increases when we provide them to our Readers again. 
    We save trees by saving books from getting wasted.
    This book app supports literacy.
    We want to be the reader's partner and their first choice.
    This system considers education as a powerful weapon.
    We want to make our country more powerful than ever.
    We care for our Donor's request and user's demand no matter in which part of India they live.
    </p>
    <div>
      <div class='text-center my-3'>
        <h5>Books available<h5>
      </div>
      <!--second child-->
      <div class="row my-2">
        <div class="card-group card-group-scroll">
          <?php
          $select_books = "select * from `books` order by rand() limit 0,9";
          $result_query = mysqli_query($con, $select_books);
          while ($row = mysqli_fetch_assoc($result_query)) {
            $book_id = $row['book_id'];
            $book_title = $row['book_title'];
            $description = $row['book_desc'];
            $book_author = $row['book_author'];
            $book_keywords = $row['book_keyword'];
            $book_publisher = $row['publisher_id'];
            $book_category = $row['category_id'];
            $book_image1 = $row['bImage1'];
            //echo $row['book_title'];
            echo
            "<div class='col-md-3 mb-2 item mx-2'>
                            <div class='card' style='backround-color:rgb(181, 151, 121, 0.5);'>
                            <img src='../donor/book_images/$book_image1' class='card-img-top' alt='...'>
                            <div class='card-body text-center'>
                                <h5 class='card-title'>$book_title</h5>
                                <p class='card-text'><b>Author:</b>$book_author</p>
                                <p class='card-text'>$description</p>
                                <a href='../index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>  
                            </div>
                            </div>
                        </div>";
          }
          ?>
        </div>
      </div>
    </div>
    <!--If needed footer can be added-->
    <?php
    include("../includes/footer.php")
    ?>
    <!--third child-->
    <div class="container my-3">
      <?php
      if (isset($_GET['insert_category'])) {
        include('insert_categories.php');
      }
      if (isset($_GET['insert_publisher'])) {
        include('insert_publishers.php');
      }
      if (isset($_GET['insert_books'])) {
        include('insert_books.php');
      }

      ?>
    </div>

    <!--bootstrap JS link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>