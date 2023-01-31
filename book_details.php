<!-- Including connect file-->
<?php
include('includes/connect.php');
include('functions/common_fun.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BooksApp using PHP and mysql</title>
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
        <img src="./images/logo.jpg" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home/home.php">Home</a>
            </li>
            <!-- Category menu -->
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Category</a>
            </li>
          </ul>
          <!--calling cart function-->
          <?php
          cart();
          ?>
          <span class="navbar-text">
            <ul class="navbar-nav me-auto" style="text-color: white">
              <li class="nav-item">
                <a class="nav-link" href="#">Welcome Guest</a>
              </li>
          </span>
          <li class="nav-item">
            <a class="nav-link" href="login/login.php">Login</a>
          </li>
          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search Books" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_book">
          </form>
        </div>
      </div>
    </nav>
    </li>
    </ul>
    </nav>

    <!--Third child-->
    <div class="row" style="padding-top: 50px; position:relative; height:100vh">
      <div class="col-md-2 sidenav">
        <!--Publications to be displayed-->
        <ul class="navbar-nav me-auto text-center sidenav-list">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <h4 class="side_heading">Publications</h4>
            </a>
          </li>

          <!--Dynamically fetch publishers from database-->
          <?php
          getPublisher();
          ?>
        </ul>

        <!--Categories to be displayed-->
        <ul class="navbar-nav me-auto text-center sidenav-list">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <h4 class="side_heading">Categories</h4>
            </a>
          </li>
          <!--Dynamically fetch categories from database-->
          <?php
          getCategories();
          ?>
        </ul>
        <!--Authors to be displayed-->
        <ul class="navbar-nav me-auto text-center sidenav-list">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <h4 class="side_heading">Authors</h4>
            </a>
          </li>
          <!--Dynamically fetch categories from database-->
          <?php
          getAuthors();
          ?>
        </ul>
      </div>

      <div class="col-md-10 py-5">
        <!--books-->
        <div class="row">
          <!--view more data -->
          <?php
          // function declared in functions/common_fun.php
          view_details();
          getParticularCategory();
          getParticularPublisher();
          ?>
        </div>
      </div>
    </div>
  </div>
  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>