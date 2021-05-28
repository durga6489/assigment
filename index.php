<?php
session_start();

include "dbconnections.php";



?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Login Form</title>




	<link rel="stylesheet" href="css/login style.css">




</head>

<?php


if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$pass_hash = md5($password);

	if (!empty($email) && !empty($password)) {

		$query =  "  SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$pass_hash."'  ";
		$query_run = mysqli_query($mycon, $query);
		$num_rows = mysqli_num_rows($query_run);

		if ($num_rows > 0) {
			$row = mysqli_fetch_assoc($query_run);
			$_SESSION['user_role'] = $row['role'];
			$_SESSION['user_firstname'] = $row['firstname'];
			$_SESSION['user_lastname'] = $row['lastname'];
			$_SESSION['user_id'] = $row['id'];

			?>

			<script type="text/javascript">
				window.location = "user_details.php"
			</script>
			<?php
		} else {
			

			$msg = 'Invalid Email and password!!';
		}
		
	} else {

		echo 'please enter username and password!';
	}
}
?>

<body>
	

	<div class="login">
		<div class="login-triangle"></div>

		<h2 class="login-header">Log in</h2>
		<?php
		if (isset($msg)) {
			echo '<div style="background:red;color:white;padding:10px;">' . $msg . '</div>';
		}elseif (isset($_GET['status'])) {
			echo '<div style="background:green;color:white;padding:10px;">' . $_GET['status'] . '</div>';
		}

		

		?>
		<form class="login-container" name="form1" action="" method="post">
			<p><input type="text" placeholder="Email" required name="email"></p>
			<p><input type="password" placeholder="Password" required name="password"></p>
			<p><input type="submit" name="submit" value="Log in"></p>
			<center>OR</center>
		</form>
		<p><input type="submit" name="submit2" value="Registration" onclick="window.location.href='use_registration.php'"></p>

	</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>





</body>

</html>
