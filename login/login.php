<?php
include('../includes/connect.php');
include('../functions/common_fun.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login page</title>
	<!--bootstrap CSS link-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!--font awesome link-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- css -->
	<link href='../login/login.css' rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="header">
			<a href="../landing.html">
				<img src="../images/logo.jpg" class="logo">
			</a>
			<a href="../home/home.php" style="color: #9A5222; text-decoration: none; font-size: 20px; margin-left: 20px;">Home</a>
		</div>
		<div class="forms">
			<div class="user-details">
				<h1>Login</h1>
				<form method="post" action="" name="login">
					<div class="input-box">
						<span class="details">First name</span>
						<input type="text" id="fname" placeholder="Enter your first name" required="required" name="fname">
					</div>
					<div class="input-box">
						<span class="details">Email</span>
						<input type="text" id="email" placeholder="Enter your email" required="required" name="email">
					</div>
					<div class="input-box">
						<span class="details">Password</span>
						<input type="password" id="password" placeholder="Enter your password" name="password" required="required">
					</div>
					<div>Forgot Password ?</div>
					<!-- login button -->
					<div class="button text-center">
						<button type="submit" name="login_btn">Login</button>
					</div>
				</form>
				<div class="signup text-center py-4">
					<span class="text small">Haven't registered yet ?</span>
					<a href="signup.php" class="text-dark">SignUp</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>

<?php
if (isset($_POST['login_btn'])) {
	$name = $_POST['fname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$select_query = "select * from `login` where email = '$email'";
	$result = mysqli_query($con, $select_query);
	$row_count = mysqli_num_rows($result);
	$user_pswd = mysqli_fetch_assoc($result);
	$user_ip = getIPAddress();

	$select_query_cart = "select * from `cart_details` where Ip_address='$user_ip'";
	$result_cart = mysqli_query($con, $select_query_cart);
	$row_count_cart = mysqli_num_rows($result_cart);
	if ($row_count > 0) {
		//redirecting to home page if user logged in successfully
		if (password_verify($password, $user_pswd['password'])) {
			if ($row_count == 1 and $row_count_cart == 0) {
				session_start();
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				echo "<script>alert('Login Successful')</script>";
				echo "<script>window.open('../home/home.php','_self')</script>";
			} else {
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $name;
				echo "<script>alert('Login Successful')</script>";
				echo "<script>alert('You have items in your cart')</script>";
				//include('successful.php');
				echo "<script>window.open('../home/home.php','_self')</script>";
			}
		} else {
			echo "<script>alert('Login unsuccessful, enter valid credentials')</script>";
			echo "<script>window.open('login.php','_self')</script>";
		}
	} else {
		echo "<script>alert('Login unsuccessful')</script>";
	}
} else {
	echo "<script>alert('Going to Login page')</script>";
}

//selecting cart items
/*$select_cart_items = "select * from `cart_details` where Ip_address = '$user_ip'";
		$result_cart=mysqli_query($con, $select_cart_items);
		$row_count = mysqli_num_rows($result_cart);
		if($row_count>0){
			$_SESSION['email'] = $email;
			echo"<script>alert('You have items in your cart')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}else{
			echo "<script>window.open('../index.php','_self')</script>";
		}*/

?>