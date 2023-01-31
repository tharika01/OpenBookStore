<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My orders</title>
</head>

<body>
    <!-- Displaying the orders made by the user who logged in, user is identified based on their IP Address -->
    <h2>My Orders</h2>
    <table class="table table-bordered text-center" style="width: 50%;border:2px solid black;">

        <tbody class="text-center">
            <!--php code to display order successful details from cart table-->
            <?php
            global $con;
            $get_ip_add = getIPAddress();
            $cart_query = "select * from `orders` where donor_ip='$get_ip_add'";
            $result = mysqli_query($con, $cart_query);
            $result_count = mysqli_num_rows($result);
            if ($result_count > 0) {
                echo " <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Book Image</th>
                        <th>Order Date</th>
                    </tr>
                  </thead>";
                while ($row = mysqli_fetch_array($result)) {
                    $book_id = $row['book_id'];
                    $select_books = "select * from `orders` where book_id='$book_id'";
                    $result_books = mysqli_query($con, $select_books);
                    while ($row_book_fetch = mysqli_fetch_array($result_books)) {
                        $book_title = $row_book_fetch['book_title'];
                        $book_image1 = $row_book_fetch['bImage1'];
                        $donation_date = $row_book_fetch['date_ordered'];
            ?>
                        <tr class="">
                            <style>
                                .cart_img {
                                    object-fit: contain;
                                    width: 200px;
                                    height: 200px;
                                    display: block;
                                    margin: auto;
                                }
                            </style>
                            <td><?php echo $book_title ?></td>
                            <td><img src="../donor/book_images/<?php echo $book_image1 ?>" alt="" class="cart_img"></td>
                            <td><?php echo $donation_date ?></td>
                        </tr>
            <?php
                    }
                }
            } else {
                echo "<h2 class='text-center text-danger'>No orders found</h2>";
                echo "<button class='px-3 py-2 border-1 mx-3'><a href='../index.php' class='text-decoration-none'>Start Shopping</a></button>";
            }
            ?>

        </tbody>
    </table>
</body>

</html>