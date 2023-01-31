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
	<title>Document</title>
	<!--bootstrap CSS link-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!--font awesome link-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!--css file-->
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<div class="container">
		<div class="title">SignUp</div>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-outline">
				<div class="user-details">
					<div class="input-box">
						<span class="details">First Name</span>
						<input type="text" id="user_fname" placeholder="Enter your first name" required="required" name="user_fname">
					</div>
					<div class="input-box">
						<span class="details">Last Name</span>
						<input type="text" id="user_lname" placeholder="Enter your last name" required="required" name="user_lname">
					</div>
					<div class="input-box">
						<span class="details">Email</span>
						<input type="email" id="email" placeholder="Enter your email" required="required" name="email">
					</div>
					<div class="input-box">
						<span class="details">Phone Number</span>
						<input type="number" id="phone_num" placeholder="Enter your Phone number" required="required" name="phone_num">
					</div>
					<div class="input-box">
						<span class="details">Password</span>
						<input type="password" id="password" placeholder="Enter your password" required="required" name="password">
					</div>
					<div class="input-box">
						<span class="details">Confirm password</span>
						<input type="password" id="confirm_password" placeholder="Re-Enter your Password" required="required" name="confirm_password">
					</div>
					<div class="input-box">
						<span class="details">Address</span>
						<input type="text" id="address" placeholder="Enter your Address" required="required" name="address">
					</div>
					<div class="input-box">
						<span class="details">Profile photo</span>
						<input type="file" id="user_image" placeholder="Upload profile photo" required="required" name="user_image">
					</div>
				</div>
			</div>
			<div class="button py-2 px-3 text-center">
				<button type="submit" name="signup_btn">SignUp</button>
			</div>
		</form>
		<div class="py-3 text-center">
			<span class="small">Already a member ?</span>
			<a href="login.php" class="text-dark">Login Now</a>
		</div>
	</div>
</body>

</html>

<!-- php code -->
<?php
if (isset($_POST['signup_btn'])) {
	$user_fname = $_POST['user_fname'];
	$user_lname = $_POST['user_lname'];
	$email = $_POST['email'];
	$phone_num = $_POST['phone_num'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	//creating a hasg value for the password and storing the hash password into db for security
	$hash_password = password_hash($password, PASSWORD_DEFAULT);
	$confirm_password = $_POST['confirm_password'];

	$user_image = $_FILES['user_image']['name'];  //accessing using 2 attributes name and temp name
	$user_image_temp = $_FILES['user_image']['tmp_name'];

	//getting the ip address of the user
	$user_ip = getIPAddress();

	//select the email from the login table, checking to avoid duplicate email entries
	$select_query = "select * from `login` where email='$email'";
	$result = mysqli_query($con, $select_query);
	$user_count = mysqli_num_rows($result);
	//checking if email-id already exists
	if ($user_count > 0) {
		echo "<script>alert('EmailId already exists')</script>";
	} elseif ($password != $confirm_password) //checking if the passwords entered are the same
	{
		echo "<script>alert('Passwords do not match')</script>";
		echo "<script>window.open('signup.php','_self')</script>";
	} else {
		//insert the user into login table
		$insert_query = "insert into `login` (user_fname,user_lname,email,password,phone_num,address,user_ip,user_image)
			values ('$user_fname','$user_lname', '$email', '$hash_password', '$phone_num','$address','$user_ip', '$user_image');";
		$result_insert_query = mysqli_query($con, $insert_query);

		//moving uploaded images to a folder
		move_uploaded_file($user_image_temp, "./profile_photos/$user_image");
		if ($result_insert_query) {
			echo "<script>alert('Login details entered successfully')</script>";
			echo "<script>window.open('login.php','_self')</script>";
		} else {
			die(mysqli_error($con));
		}
	}

	//selecting cart items
	$select_cart_items = "select * from `cart_details` where Ip_address = '$user_ip'";
	$result_cart = mysqli_query($con, $select_cart_items);
	$rows_count = mysqli_num_rows($result_cart);
	if ($rows_count > 0) {
		$_SESSION['email'] = $email;
		echo "<script>alert('You have items in cart')</script>";
		echo "<script>window.open('../checkout.php', '_self')</script>";
	} else {
		echo "<script>window.open('../index.php', '_self')</script>";
	}
}

?>