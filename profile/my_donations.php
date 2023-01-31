<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- displaying the books donated by the user -->
    <!-- user is identified based on ip address since every user's IP address is different -->
    <h2>My Donations</h2>
    <table class="table table-bordered text-center" style="width: 50%;border:2px solid black;">

        <tbody class="text-center w-50">
            <!--php code to display dynamic cart data-->
            <?php
            // selecting the books from donor table where IP address matches
            global $con;
            $my_ip = getIPAddress();
            $select_books = "select * from `donor` where donor_ip = '$my_ip'";
            $result = mysqli_query($con, $select_books);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
                echo " <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Image</th>
                    </tr>
                  </thead>";
                while ($row = mysqli_fetch_array($result)) {
                    $book_id = $row['book_id'];
                    $select_books = "select * from `donor` where donor_ip = '$my_ip' and book_id = $book_id";
                    $result_books = mysqli_query($con, $select_books);
                    while ($row_book_fetch = mysqli_fetch_array($result)) {
                        $book_title = $row_book_fetch['book_title'];
                        $book_image = $row_book_fetch['bImage'];
            ?>
                        <tr>
                            <td><?php echo $book_title ?></td>
                            <style>
                                .cart_img {
                                    object-fit: contain;
                                    width: 200px;
                                    height: 200px;
                                    display: block;
                                    margin: auto;
                                }
                            </style>
                            <td><img src="../donor/book_images/<?php echo $book_image ?>" alt="" class="cart_img"></td>
                        </tr>
            <?php
                    }
                }
            } else {
                echo "<h2 class='text-center text-danger'>You haven't made any donation</h2>";
                echo "<button class='px-3 py-2 border-1 mx-3'><a href='../donor/index.php' class='text-decoration-none'>Donate Now!</a></button>";
            }
            ?>

        </tbody>
    </table>
</body>

</html>