<!-- Including connect file-->
<?php
//include('./includes/connect.php');  since $con is declared as global no issue
//function to get the books
function getBooks()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['publisher'])) {
            $select_books = "select * from `books` order by rand()";
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
                "<div class='col-md-4 item'>
                            <div class='card'>
                            <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$book_title</h5>
                                <p class='card-text'>$description</p>
                                <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                                <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                            </div>
                            </div>
                        </div>";
            }
        }
    }
}

//getting the books of a particular category
function getParticularCategory()
{
    global $con;
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_books = "select * from `books` where category_id = $category_id ";
        $result_query = mysqli_query($con, $select_books);
        $num_books = mysqli_num_rows($result_query);
        if ($num_books == 0) {
            echo "<h2 class ='text-center text-danger'>No stock for this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $book_id = $row['book_id'];
            $book_title = $row['book_title'];
            $description = $row['book_desc'];
            $book_author = $row['book_author'];
            $book_keywords = $row['book_keyword'];
            $publisher_id = $row['publisher_id'];
            $category_id = $row['category_id'];
            $book_image1 = $row['bImage1'];
            //echo $row['book_title'];
            echo
            "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                        <div class='card-body'>
                        <h4 class='card-title'>$book_title</h4>
                        <p class='card-text'>$description</p>
                            <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                            <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                        </div>
                        </div>
                    </div>";
        }
    }
}

//getting the books of a particular publisher
function getParticularPublisher()
{
    global $con;
    if (isset($_GET['publisher'])) {
        $publisher_id = $_GET['publisher'];
        $select_books = "select * from `books` where publisher_id = $publisher_id ";
        $result_query = mysqli_query($con, $select_books);
        $num_books = mysqli_num_rows($result_query);
        if ($num_books == 0) {
            echo "<h2 class ='text-center text-danger'>No stock for books by this publisher</h2>";
        }
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
            "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                        <div class='card-body'>
                        <h5 class='card-title'>$book_title</h5>
                        <p class='card-text'>$description</p>
                            <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                            <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                        </div>
                        </div>
                    </div>";
        }
    }
}

//getting the books of a particular author
function getParticularAuthor()
{
    global $con;
    if (isset($_GET['author'])) {
        $author_name = $_GET['author'];
        $select_books = "select * from `books` where book_author='$author_name'";
        $result_query = mysqli_query($con, $select_books);
        $num_books = mysqli_num_rows($result_query);
        if ($num_books == 0) {
            echo "<h2 class ='text-center text-danger'>No stock for books by this author</h2>";
        }
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
            "<div class='col-md-4 mb-2'>
                    <div class='card'>
                        <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                        <div class='card-body'>
                        <h5 class='card-title'>$book_title</h5>
                        <p class='card-text'>$description</p>
                            <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                            <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                        </div>
                        </div>
                    </div>";
        }
    }
}

//displaying the categories in the side nav bar
function getCategories()
{
    global $con;
    $select_categories = "Select * from `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    //$row_data=mysqli_fetch_assoc($result_publishers);
    //echo $row_data['publisher_title']; only first data is displayed
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['category_title'];
        $category_id = $row_data['category_id'];
        echo "<li class='nav-item'>
                  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
                  </li>";
    }
}
//displaying the publisher names in the side nav bar
function getPublisher()
{
    global $con;
    $select_publishers = "Select * from `publisher`";
    $result_publishers = mysqli_query($con, $select_publishers);
    while ($row_data = mysqli_fetch_assoc($result_publishers)) {
        $publisher_title = $row_data['publisher_title'];
        $publisher_id = $row_data['publisher_id'];
        echo "<li class='nav-item'>
                <a href='index.php?publisher=$publisher_id' class='nav-link text-light'>$publisher_title</a>
                </li>";
    }
}
//displaying the categories in the side nav bar
function getAuthors()
{
    global $con;
    $select_all = "Select * from `author`";
    $result_books = mysqli_query($con, $select_all);
    while ($row_data = mysqli_fetch_assoc($result_books)) {
        $author_name = $row_data['book_author'];
        //$book_id = $row_data['book_id'];
        echo "<li class='nav-item'>
                  <a href='index.php?author=$author_name' class='nav-link text-light'>$author_name</a>
                  </li>";
    }
}

function getIPAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//getting all books
function get_all_books()
{
    global $con;
    if (!isset($_GET['category'])) {
        if (!isset($_GET['publisher'])) {
            $select_books = "select * from `books` order by rand()";
            $result_query = mysqli_query($con, $select_books);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $book_id = $row['book_id'];
                $book_title = $row['book_title']; //pass the column name from the database
                $book_desc = $row['book_desc'];
                $book_author = $row['book_author'];
                $bImage1 = $row['bImage1'];
                $category_id = $row['category_id'];
                $publisher_id = $row['publisher_id'];
                echo "
            <div class='col-md-4 mb-2'>
               <div class='card'>
               <img src='./donor/book_images/$bImage1' class='card-img-top' alt='$bImage1'>
               <div class='card-body'>
               <h5 class='card-title'>$book_title</h5>
               <p class='card-text'>$book_desc</p>
               <a href='index.php?add_to_cart=$book_id' class='btn btn-info'>Add to Cart</a>
               <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
               </div>
            </div>  
          </div>";
            }
        }
    }
}
//searching books function
function search_book()
{
    global $con;
    if (isset($_GET['search_data_book'])) {
        $search_data_value = $_GET['search_data'];
        $search_books = "select * from `books` where book_keyword like '%$search_data_value%'"; //at any position apple is present then that data is displayed
        $result_query = mysqli_query($con, $search_books);
        $num_books = mysqli_num_rows($result_query);
        if ($num_books == 0) {
            echo "<h2 class='text-center text-danger'>This book is not available</h2>";
        }
        //global $con;
        //$select_books = "select * from `books` order by rand()";
        //$result_query = mysqli_query($con, $select_books);
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
            "<div class='col-md-4 mb-2 item'>
                <div class='card'>
                    <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                    <div class='card-body'>
                    <h5 class='card-title'>$book_title</h5>
                    <p class='card-text'>$description</p>
                    <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                    <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                </div>
                </div>
            </div>";
        }
    }
}

//view details function
function view_details()
{
    global $con;
    if (isset($_GET['book_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['publisher'])) {
                $book_id = $_GET['book_id'];
                $select_books = "select * from `books` where book_id=$book_id";
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
                    $book_image2 = $row['bImage2'];
                    $book_image3 = $row['bImage3'];
                    //echo $row['book_title'];
                    echo
                    "<div class='col-md-4 item'>
                        <div class='card'>
                            <img src='./donor/book_images/$book_image1' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <h5 class='card-title'>$book_title</h5>
                                <p class='card-text'>$description</p>
                                <a href='index.php?add_to_cart=$book_id' class='btn_card'>Add to Cart</a>
                                <a href='book_details.php?book_id=$book_id' class='btn_card'>View More</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class='col-md-6' style='background:#c49779;object-fit:contain'>
                        <!-- more image image -->
                        <div class=''>
                        <br>
                            <div class=''>
                                <h4 class='text-center'>Book Details</h4>
                            </div>
                            <br>
                            <div class=''>
                                <p class=''><b>Book Title:</b> $book_title</p>
                            </div>
                            <div class=''>
                                <p class=''><b>Author name:</b> $book_author</p>
                            </div>
                            <!--<div class=''>
                                <div class=''><b>Number of books</b> : $description</div>
                            </div>-->
                            <div class=''>
                                <div class=''><b>Book Description</b> : $description</div>
                            </div>
                            <div>
                            
                        </div>
                        <style>
                            .img_view{
                                height:200px;
                                width:200px;
                                object-fit:contain;
                                margin:auto;
                            }
                        </style>
                        <div class='text-center'>
                        <br>
                            <h4 class='text-center'>More images</h4>
                            <br>
                        </div>
                        <div class='row' >
                            <div class='col-md-4'>
                                <img src='./donor/book_images/$book_image2' class='img_view' alt='$book_title'>
                            </div>
                            <div class='col-md-4'>
                                <img src='./donor/book_images/$book_image3' class='img_view' alt='$book_title'>
                            </div>
                        </div>
                        </div>
                        <br>
                    </div>";
                }
            }
        }
    }
}
//$ip = getIPAddress();  
//echo 'User Real IP Address - '.$ip; 

//cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress(); //result ::1
        $get_book_id = $_GET['add_to_cart'];

        $select_query = "select * from `cart_details` where ip_address='$get_ip_add' and book_id=$get_book_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows > 0) {
            echo "<script>alert('This item is already present in the cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "insert into `cart_details` (book_id,ip_address,quantity) values ($get_book_id,'$get_ip_add',0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('This item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

//function to get cart item numbers
function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress(); //result ::1
        //$get_book_id=$_GET['add_to_cart'];
        $select_query = "select * from `cart_details` where ip_address='$get_ip_add'"; // and book_id=$get_book_id";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    } else {
        global $con;
        $get_ip_add = getIPAddress(); //result ::1
        //$get_book_id=$_GET['add_to_cart'];

        $select_query = "select * from `cart_details` where ip_address='$get_ip_add'"; // and book_id=$get_book_id";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
}



?>