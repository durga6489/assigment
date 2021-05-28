<?php
session_start();
error_reporting(0);
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
		
	if (isset($_POST['first_name_inp'])) {


		$first_name = $_POST['first_name_inp'];
		$last_name = $_POST['last_name_inp'];
		$email = $_POST['email_inp'];

		$mobile = $_POST['mobile_inp'];

		$department = $_POST['department_inp'];
		$designation = $_POST['designation_inp'];
		$role = $_POST['role_inp'];
		$password = $_POST['password_inp'];
		$compassword = $_POST['compassword_inp'];
		$slquery = "SELECT * FROM user WHERE email = '" . $email . "'";
		$selectresult = mysqli_query($mycon, $slquery);
		$slquermob= "SELECT * FROM user WHERE mobile = '" . $mobile . "'";
		$selectresultmod = mysqli_query($mycon, $slquermob);
		

		$email_suffix = explode("@", $email);

		if(strlen($_POST['password_inp']) < 5 || strlen($_POST['password_inp']) > 8){
			$msg = 'Password should be between 5 to 8 characters';
		} elseif ($email_suffix[1] != "chrp-india.com") {
			$msg = 'Enter valid email, should enter official mail id';
		}/* elseif (empty($_POST['mobile_inp'])<10 && !preg_match('/^[7-9]*$/',$_POST['mobile_inp'])){	
            $msg = 'Please Enter Mobile Number Or Enter Valid Mobile Number.';
		echo "durga";}*/
		elseif (mysqli_num_rows($selectresult) > 0) {
			$msg = 'Email already exists';
		} elseif(mysqli_num_rows($selectresultmod) > 0){
            $msg = 'Mobile Number already exists';
		}elseif ($password != $compassword) {
			$msg = "Password doesn't match";
		} else {

			$password = md5($_POST['password_inp']);

			// SELECT `id`, `firstname`, `lastname`, `email`, `mobile`, `department`, `designation`, `role`, `password` FROM `user` WHERE 1
			echo $query = "INSERT INTO user( `firstname`, `lastname`, `email`, `mobile`, `department`, `designation`, `role`, `password`) VALUES ('" . $first_name . "', '" . $last_name . "', '" . $email . "', '" . $mobile . "','" . $department . "','" . $designation . "','" . $role . "','" . $password . "')";


			$sql = mysqli_query($mycon, $query);

			if ($sql) {
				header("Location: index.php?status=User Registered Successfully!");
			} else {
				$msg = "Could Not Perform the Query";
			}
		}
	}else{
        
		$first_name ="";
		$last_name ="";
		$email ="";

		$mobile ="";

		$department ="";
		$designation ="";
		$role ="";



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
		<form class="login-container" name="form1" id="form1" action="use_registration.php" method="POST">
			<p><input type="text" placeholder="First name" required name="first_name_inp" value="<?=$first_name?>" form="form1"></p>
			<p><input type="text" placeholder="Last name" required name="last_name_inp" value="<?=$last_name?>" form="form1"></p>
			<p><input type="email"placeholder="Email" required name="email_inp" value="<?=$email?>" form="form1"></p>
			<p><input type="text" placeholder="Mobile No" maxlength="10" name="mobile_inp"id="mobile_inpaa"  onkeypress="return onlyNumberKey(event)" autocomplete="off" required value="<?=$mobile?>" form="form1"></p>


			<div>
				<div>
					<div>
						<label class="login-container" name="department_inp" <?=$department?>" form="form1"> Department :</label>
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
			<p> <input type="button" name="submit1" onclick="formsubmit()" value="Submit"></input></p>
			<!-- <button type="button" name="submit1" onclick="formsubmit()">Save</button> -->
			
			<center>
				Or<br>
				Already have an account? <a href="index.php">Login</a>
			</center>
		</form>

		

	</div>

</body>

<script>

function onlyNumberKey(evt) {
         
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
function formsubmit(){

	var p = document.getElementById("password_inpaa").value;

	if(p.length >= 5 && p.length <= 8){
	//$("#form1").submit();
//$('form#form1').submit();
//document.getElementById("form1").submit();
var form = document.getElementById("form1");
form.submit();
	}else{
		alert("Password should be between 5 to 8 characters")
	}
}
</script>
 </html>