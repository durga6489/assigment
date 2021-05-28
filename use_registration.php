<?php
session_start();

include "dbconnections.php";
?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Register Form</title>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>


	<link rel="stylesheet" href="css/login style.css">




</head>

<body>

	<?php

	if (isset($_POST['submit1'])) {


		$first_name = $_POST['first_name_inp'];
		$last_name = $_POST['last_name_inp'];
		$email = $_POST['email_inp'];

		$mobile = $_POST['mobile_inp'];

		$department = $_POST['department_inp'];
		$designation = $_POST['designation_inp'];
		$role = $_POST['role_inp'];
		$password = $_POST['password_inp'];
		$compassword = $_POST['compassword_inp'];
		//$slquery = "SELECT * FROM user WHERE email = '" . $email . "'";
		//$selectresult = mysqli_query($mycon, $slquery);

		//$email_suffix = explode("@", $email);

		if(strlen($_POST['password_inp']) < 5 || strlen($_POST['password_inp']) > 8){
			$msg = 'Password should be between 5 to 8 characters';
		 }//elseif ($email_suffix[1] != "chrp-india.com") {
		// 	$msg = 'Enter valid email, should enter official mail id';
		// } 
		elseif (mysqli_num_rows($selectresult) > 0) {
			$msg = 'Email already exists';
		} elseif ($password != $compassword) {
			$msg = "Password doesn't match";
		} else {

			$password = md5($_POST['password_inp']);

			// SELECT `id`, `firstname`, `lastname`, `email`, `mobile`, `department`, `designation`, `role`, `password` FROM `user` WHERE 1
			$query = "INSERT INTO user( `firstname`, `lastname`, `email`, `mobile`, `department`, `designation`, `role`, `password`) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $mobile . "','" . $department . "','" . $designation . "','" . $role . "','" . $password . "')";


			$sql = mysqli_query($mycon, $query);

			if ($sql) {
				header("Location: index.php?status=User Registered Successfully!");
			} else {
				$msg = "Could Not Perform the Query";
			}
		}
	}

	?>

	<div class="login">
		<div class="login-triangle"></div>

		<h2 class="login-header">Register</h2>
		<?php
		if (isset($msg)) {
			echo '<div style="background:red;color:white;padding:10px;">' . $msg . '</div>';
		}

		?>
		<form class="login-container" name="form1" id="form1" action="" method="POST">
			<p><input type="text" placeholder="First name" required name="first_name_inp"></p>
			<p><input type="text" placeholder="Last name" required name="last_name_inp"></p>
			<p><input type="email" placeholder="Email" required name="email_inp" id="email_inp"></p>
			<p><input type="text" placeholder="Mobile No" name="mobile_inp" pattern="^\d{10}$"></p>


			<div>
				<div>
					<div>
						<label class="login-container" name="department_inp"> Department :</label>
						<select name='department_inp' onchange="depchange(this.value)" class="selectstyle" required>
							<option disabled selected>Select</option>
							<?php
							$dep = mysqli_query($mycon, "select * from department");
							foreach ($dep as $key => $value) {
							?><option value="<?= $value['dep_id'] ?>"><?= $value['dep_name'] ?></option><?php
																									} ?>
						</select>
						<script>
							function depchange(depid) {

								$.post("ajax.php", {
										action: "department_change",
										id: depid
									})
									.done(function(data) {
										// console.log(data);
										// alert("Data Loaded: " + data);
										$('#designation_input').html(data);
									});
							}
						</script>
					</div>
				</div>
				<br>
				<div>
					<div>
						<label class="login-container" name="designation_inp"> Designation :</label>
						<select name='designation_inp' id="designation_input">
							<option>Select</option>
						</select>
					</div>
				</div>
				<br>
				<div>
					<div>

						<label class="login-container" name="role_inp"> Role :</label>
						<select name='role_inp'>
							<?php
							$dep = mysqli_query($mycon, "select * from role");
							foreach ($dep as $key => $value) {
							?>
								<option value="<?= $value['id'] ?>"><?= $value['role_name'] ?></option>
							<?php
							} ?>
						</select>
					</div>
				</div>
			</div>


			<p><input type="Password" placeholder="Password" required name="password_inp" id="password_inpaa"></p>

			<p><input type="Password" placeholder="Confirm Password" required name="compassword_inp"></p>

			<!-- <p> <input type="submit" name="submit1" value="Save"></p> -->
			<button type="button" name="submit1" onclick="formsubmit()">Save</button>
			
			<center>
				Or<br>
				Already have an account? <a href="index.php">Login</a>
			</center>
		</form>

		

	</div>

</body>

<script>

function formsubmit(){
	var p = document.getElementById("password_inpaa").value;
	var es = document.getElementById("email_inp").value;
	emailchange(es);
    if(!es==1){
		$("#form1").submit();
	}else{
		alert("Email should not be ---")
	}
	if(p.length >= 5 && p.length <= 8){
		$("#form1").submit();
	}else{
		alert("Password should be between 5 to 8 characters")
	}
}

function emailchange(e) {

	$.post("ajax.php", {
		action: "email_check",
		email_id: e
		})
		.done(function(data) {
		// console.log(data);
		alert("Data Loaded: " + data);
		//$('#designation_input').html(data);
	});
}
</script>

</html>