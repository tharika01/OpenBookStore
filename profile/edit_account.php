<?php
if (isset($_GET['edit_account'])) {
    $user_email = $_SESSION['email'];
    //select the details of the user who has logged in
    $select_query = "select * from `login` where email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $user_data = mysqli_fetch_assoc($result);
    //saving the fetched data in var
    $user_id = $user_data['user_id'];
    $user_fname = $user_data['user_fname'];
    $user_lname = $user_data['user_lname'];
    $email = $user_data['email'];
    $phone_num = $user_data['phone_num'];
    $address = $user_data['address'];
    $password = $user_data['password'];
}
if (isset($_POST['update_details'])) {
    $update_id = $user_id;
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $email = $_POST['email'];
    $phone_num = $_POST['phone_num'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    //creating a hasg value for the password and storing the hash password into db for security
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $user_image = $_FILES['profile_photo']['name'];
    //$temp_image = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image, "../login/profile_photos/$user_image");

    //update the user details
    $update_det = "update `login` set user_id = '$user_id', user_fname='$user_fname',
     user_lname='$user_lname',email='$email', password='$hash_password',address='$address',
     phone_num='$phone_num',user_image='$user_image' where user_id = $update_id";
    $update_res = mysqli_query($con, $update_det);
    if ($update_res) {
        echo "<script>alert('data Updated successfully')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- css Style sheet  -->
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
</head>

<body>
    <h2 class="text-center">
        Edit Account
    </h2>
    <form action="" method="post" enctype="multipart/form-data" class="mb-2">
        <!--First name-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="user_fname" class="from-label ">First Name</label>
            <input type="text" name="user_fname" id="user_fname" class="form-control" value="<?php echo "$user_fname"; ?>" autocomplete="off" required="required">
        </div>
        <!--Last name-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="user_lname" class="from-label ">Last Name</label>
            <input type="text" name="user_lname" id="user_lname" class="form-control" value="<?php echo "$user_lname"; ?>" autocomplete="off" required="required">
        </div>
        <!--Image -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="profile_photo" class="from-label ">Profile Photo</label>
            <input type="file" name="profile_photo" id="profile_photo" class="form-control" autocomplete="off" required="required">
            <img src="../login/profile_photos/<?php echo $user_image; ?>" alt="" class="donor_image text-center">
        </div>
        <!--Phone number-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="phone_num" class="from-label ">Phone Number</label>
            <input type="text" name="phone_num" id="phone_num" class="form-control" value="<?php echo "$phone_num"; ?>" autocomplete="off" required="required">
        </div>
        <!-- address -->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="address" class="from-label ">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="<?php echo "$address"; ?>" autocomplete="off" required="required">
        </div>
        <!--email-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="email" class="from-label ">Email-ID</label>
            <input type="text" name="email" id="email" class="form-control" value="<?php echo "$email"; ?>" autocomplete="off" required="required">
        </div>
        <!--Password-->
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="password" class="from-label ">Password</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo "$password"; ?>" autocomplete="off" required="required">
        </div>
        <!--Update button-->
        <div class="form-outline mb-4 w-50 m-auto text-center">
            <input type="submit" name="update_details" class="btn mb-3 px-3" value="Update Details" style="color: antiquewhite; background-color: brown;">
        </div>
    </form>
</body>

</html>