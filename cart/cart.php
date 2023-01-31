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
  <title>Cart details</title>
  <!--bootstrap CSS link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!--font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--css file-->
  <link rel="stylesheet" href="../style.css">
  <style>
    .cart_img {
      width: 120px;
      height: 120px;
    }
  </style>
</head>

<body>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg  fixed-top navbar-light" style="height: 50px; background-color:rgba(132, 68,28, 0.8); text-color:#F4DCC4;">
    <div class="container-fluid">
      <img src="../images/logo.jpg" alt="" class="logo">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="color: white; list-style: none;">
          <!-- home -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../home/home.php">Home</a>
          </li>
          <!-- Category -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Category</a>
          </li>
          <!-- cart -->
          <li class="nav-item">
            <a class="nav-link" href="cart.php">Cart<i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <sup><!-- displaying the number of items in cart in superscript -->
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
          <!-- login and donate or register -->
          <li class="nav-item">
            <!-- login if user not logged in yet , and logout if user has already logged in -->
            <?php
            if (!isset($_SESSION['email'])) {
              echo
              "<span class='navbar-text'>
                <li class='nav-item'>
                  <a class='nav-link' href='login.php'>Login</a>
                </li>  
              </span>";
            } else {
              echo
              "<!-- Donor page link -->
                <li class='nav-item'>
                  <a class='nav-link' href='../donor/index.php'>Donate<i class='fa fa-heart'></i></a>
                </li>
                <li class='nav-item' style='color: white; list-style: none;'>
                  <a class='nav-link' href='../profile/profile.php'>Profile<i class='fa fa-user' aria-hidden='true'></i></a>
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
        <!--calling cart function-->
        <?php
        cart();
        ?>
        <!-- <ul class="navbar-nav me-auto" style="text-color: white"> -->

        <?php
        //displaying personalized welcome message
        if (!isset($_SESSION['email'])) {
          echo
          "<span class='navbar-text'>
              <li class='nav-item' style='color: white; list-style: none;'>
                <a class='nav-link' href='#' style='color: white;'>Welcome Guest</a>
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

        <!-- </ul> -->
      </div>
    </div>
  </nav>


  </li>
  </ul>
  </nav>
  <!--calling cart function-->
  <?php
  cart();
  ?>
  <div class="about my-5">
    <h5 class="text-center">Cart</h5>
    <div>
      <!--Fourth child-->
      <div class="continer">
        <div class="class row py-5">
          <form action="" method="post">
            <table class="table table-bordered text-center" style="width: 75%;border:2px solid black;margin-left:auto;margin-right:auto;">

              <tbody class="text-center">
                <!--php code to display dynamic cart data-->
                <?php
                global $con;
                $get_ip_add = getIPAddress();
                $cart_query = "select * from `cart_details` where ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);
                if ($result_count > 0) {
                  echo " <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                  </thead>";
                  while ($row = mysqli_fetch_array($result)) {
                    $book_id = $row['book_id'];
                    $select_books = "select * from `book_delete` where book_id='$book_id'";
                    $result_books = mysqli_query($con, $select_books);
                    while ($row_book_fetch = mysqli_fetch_array($result_books)) {
                      $book_title = $row_book_fetch['book_title'];
                      $book_image1 = $row_book_fetch['bImage1'];
                ?>
                      <tr class="">
                        <td><?php echo $book_title ?></td>
                        <td><img src="../donor/book_images/<?php echo $book_image1 ?>" alt="" class="cart_img"></td>
                        <td><input type="text" name="qty" class="form-input w-50"></td>
                        <?php
                        $get_ip_add = getIPAddress();
                        if (isset($_POST['update_cart'])) {
                          $quantities = $_POST['qty'];
                          if ($quantities == 1) {
                            $update_cart = "update `cart_details` set quantity=$quantities where Ip_address='$get_ip_add'";
                            $result_books_quantity = mysqli_query($con, $update_cart);
                          } else
                            echo "<script>alert('Sorry cannot order more than one book of same category')</script>";
                        }
                        ?>
                        <td><input type="checkbox" name="removeitem[]" value="<?php echo $book_id ?>"></td>

                      </tr>
                <?php
                    }
                  }
                } else {
                  echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
                }
                ?>

              </tbody>
            </table>
            <div class="mb-3 px-5 text-center" style="margin-left:auto;margin-right:auto;">
              <?php
              $get_ip_add = getIPAddress();
              $cart_query = "select * from `cart_details` where Ip_address='$get_ip_add'";
              $result = mysqli_query($con, $cart_query);
              $result_count = mysqli_num_rows($result);
              if ($result_count > 0) {
                echo
                "<input type='submit' value='Continue browsing' class='px-3 py-2 border-0 mx-3' name='continue_shopping'>
                <a href='../index.php'></a>
                <button class='px-3 py-2 border-1 mx-3'><a href='checkout.php' class='text-decoration-none'>Place order</a></button>
                <td>
                    <input type='submit' value='Update cart' class='px-3 py-2 border-0 mx-3' name='update_cart'>
                    <input type='submit' value='Remove cart' class='px-3 py-2 border-0 mx-3' name='remove_cart'>
                </td>";
              } else {
                echo "<input type='submit' value='Continue browsing' class='px-3 py-2 border-0 mx-3' name='continue_shopping'>";
              }
              if (isset($_POST['continue_shopping'])) {
                echo "<script>window.open('../index.php','_self')</script>";
              }
              ?>

            </div>
        </div>
      </div>
      </form>

      <!--function to remove item-->
      <?php
      function remove_cart_item()
      {
        global $con;
        if (isset($_POST['remove_cart'])) {
          foreach ($_POST['removeitem'] as $remove_id) {
            $fetch = "select * from `book_delete` where book_id=$remove_id";
            $result = $con->query($fetch);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $ip_address = getIPAddress();
                $fetch1 = $row['book_title'];
                $fetch2 = $row['book_desc'];
                $fetch3 = $row['book_author'];
                $fetch4 = $row['book_keyword'];
                $fetch5 = $row['category_id'];
                $fetch6 = $row['publisher_id'];
                $fetch7 = $row['bImage1'];
                $fetch8 = $row['bImage2'];
                $fetch9 = $row['bImage3'];
                $fetch10 = $row['status'];
              }
            }
            //inserting into temporary table which inserts data when insertion is performed on cart through trigger
            $insert_books_back = "insert into `books` (donor_ip,book_title,book_desc,book_author,book_keyword,category_id,publisher_id,bImage1,bImage2,bImage3,date_added,status)
                        values ('$ip_address','$fetch1', '$fetch2', '$fetch3', '$fetch4', '$fetch5', '$fetch6',
                        '$fetch7','$fetch8','$fetch9',NOW(), '$fetch10')";
            $insert_result = mysqli_query($con, $insert_books_back);
            $delete_query = "Delete from `cart_details` where book_id=$remove_id";
            $delete_trigger = "Delete from `book_delete` where book_id=$remove_id";
            $run = mysqli_query($con, $delete_trigger);
            $run_delete = mysqli_query($con, $delete_query);
            if ($run_delete) {
              echo "<script>window.open('cart.php','_self')</script>";
            }
          }
        }
      }
      echo $remove_item = remove_cart_item();
      ?>
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
        include('../includes/footer.php');
        ?>
      </div> -->
    </div>
    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>