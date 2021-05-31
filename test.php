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



		$department = $_POST['state_inp'];
		$designation = $_POST['city_inp'];


	}

	?>

	<div class="login">
		<div class="login-triangle"></div>

		<h2 class="login-header">testing</h2>
		<?php
		if (isset($msg)) {
			echo '<div style="background:red;color:white;padding:10px;">' . $msg . '</div>';
		}

		?>
		<form class="login-container" name="form1" id="form1" action="" method="POST">
			


			<div>
				<div>
					<div>
						<label class="login-container" name="state_inp"> State :</label>
						<select name='state_inp' onchange="statechange(this.value)" class="selectstyle" required>
							<option disabled selected>Select</option>
							<?php
							$dep = mysqli_query($mycon, "select * from states");
							foreach ($dep as $key => $value) {
							?>
							<option value="<?= $value['state_id'] ?>"><?= $value['state_name'] ?></option><?php
						}
						?>
											
						</select>
						<script>
							function statechange(stateid) {

								$.post("ajax2.php", {
										action: "state_change",
										id:stateid
									})
									.done(function(data) {
										// console.log(data);
										// alert("Data Loaded: " + data);
										$('#state_input').html(data);
									});
							}
						</script>
					</div>
				</div>
				<br>
				<div>
					<div>
						<label class="login-container" name="city_inp"> City :</label>
						<select name='city_inp' id="state_input">
							<option>Select</option>
						</select>
					</div>
				</div>
				<br>
				<div>
				



			<!-- <p> <input type="submit" name="submit1" value="Save"></p> -->
			<button type="button" name="submit1" onclick="formsubmit()">Save</button>
			
		</form>

		

	</div>

</body>
<!-- 
<script>

function formsubmit(){
	var es = document.getElementById("email_inp").value;
	emailchange(es);
    if(!es==1){
		$("#form1").submit();
	}else{
		alert("Email should not be ---")
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
</script> -->

</html> 