<?php
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
        Hello <?php echo "$user_fname"; ?>!
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
    </form>
</body>

</html>