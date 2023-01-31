<?php
include('../includes/connect.php');
if (isset($_POST['insert_book'])) {
    $donor_ip = getIPAddress();
    $book_title = $_POST['book_title'];
    $description = $_POST['description'];
    $book_author = $_POST['book_author'];
    $book_keywords = $_POST['book_keywords'];
    $category_id = $_POST['category_id'];
    $publisher_id = $_POST['publisher_id'];
    $book_status = 'true';

    //accessing images
    $book_image1 = $_FILES['book_image1']['name'];
    $book_image2 = $_FILES['book_image2']['name'];
    $book_image3 = $_FILES['book_image3']['name'];

    //accessing image temp name
    $temp_image1 = $_FILES['book_image1']['tmp_name'];
    $temp_image2 = $_FILES['book_image2']['tmp_name'];
    $temp_image3 = $_FILES['book_image3']['tmp_name'];

    move_uploaded_file($temp_image1, "./book_images/$book_image1");
    move_uploaded_file($temp_image2, "./book_images/$book_image2");
    move_uploaded_file($temp_image3, "./book_images/$book_image3");

    //insert the book into book table
    $insert_query = "insert into `books` (donor_ip,book_title,book_desc,book_author,book_keyword,category_id,publisher_id,bImage1,bImage2,bImage3,date_added,status)
            values ('$donor_ip','$book_title', '$description', '$book_author', '$book_keywords', '$category_id', '$publisher_id',
            '$book_image1','$book_image2','$book_image3',NOW(), '$book_status');";
    $result_query = mysqli_query($con, $insert_query);
    if ($result_query) {
        echo "<script>alert('successfully inserted the book details')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Books</title>
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--css file-->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="" style="background-color: antiquewhite;">
    <div class="container mt-3">
        <h1 class="text-center">Insert Books</h1>
        <!--form-->
        <!--enctype will help us add images-->
        <form action="" method="post" enctype="multipart/form-data" class="mb-2">
            <!--title-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_title" class="from-label ">Book title</label>
                <input type="text" name="book_title" id="book_title" class="form-control" placeholder="Enter book name" autocomplete="off" required="required">
            </div>
            <!--description-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="from-label ">Book description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter book description" autocomplete="off" required="required">
            </div>
            <!--author name-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="from-label ">Book Author</label>
                <input type="text" name="book_author" id="author" class="form-control" placeholder="Enter book description" autocomplete="off" required="required">
                <?php
                // stored procedures
                $fetch = "select * from `books` where date_added=NOW()";
                $result = $con->query($fetch);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        //$ip_address = getIPAddress();
                        $fetch1 = $row['book_author'];
                        $sp = mysqli_query($con, "call author_insert('$fetch1')");
                    }
                }
                ?>
            </div>
            <!--book keyword used for searching-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_keywords" class="from-label ">Book keywords</label>
                <input type="text" name="book_keywords" id="book_keywords" class="form-control" placeholder="Enter book keyword" autocomplete="off" required="required">
            </div>

            <!--categories-->
            <div class="form-outline  mb-4 w-50 m-auto">
                <label for="category_id" class="from-label ">Book category</label>
                <select name="category_id" id="" class="form-select">
                    <option value="">Select Category</option>
                    <!--Connecting category table on database to dynamically get drop down list-->
                    <?php
                    //Select all categories from category table
                    $select_query = "Select * from `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query))   //access all data present on table instead of one data
                    {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>
                </select>
            </div>


            <!--Publishers-->
            <div class="form-outline  mb-4 w-50 m-auto">
                <label for="publisher_id" class="from-label ">Book publisher</label>
                <select name="publisher_id" id="" class="form-select">
                    <option value="">Select Publisher</option>
                    <?php
                    //Select all publishers from publisher
                    $select_query = "Select * from `publisher`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query))   //access all data present on table instead of one data
                    {
                        $publisher_title = $row['publisher_title'];
                        $publisher_id = $row['publisher_id'];
                        echo "<option value='$publisher_id'>$publisher_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!--Image 1-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_image1" class="from-label ">Book image1</label>
                <input type="file" name="book_image1" id="book_image1" class="form-control" required="required">
            </div>
            <!--Image 2-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_image2" class="from-label ">Book image2</label>
                <input type="file" name="book_image2" id="book_image2" class="form-control" required="required">
            </div>
            <!--Image 3-->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="book_image3" class="from-label ">Book image3</label>
                <input type="file" name="book_image3" id="book_image3" class="form-control" required="required">
            </div>
            <!--Insert button-->
            <div class="form-outline mb-4 w-50 m-auto text-center">
                <input type="submit" name="insert_book" class="btn mb-3 px-3" value="Insert Book" style="background-color: #9A5222; color: antiquewhite;">
            </div>
        </form>
    </div>

</body>

</html>