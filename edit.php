<?php
session_start();

include "dbconnections.php";
?>




<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Edit Form</title>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>


	<link rel="stylesheet" href="css/login style.css">




</head>

<body>

	<?php

	if (isset($_POST['submit1'])) {


        
		$editid_inp = $_POST['editid_inp'];
		$first_name = $_POST['first_name_inp'];
		$last_name = $_POST['last_name_inp'];
	//	$email = $_POST['email_inp'];
		$mobile = $_POST['mobile_inp'];
		$department = $_POST['department_inp'];
		

        $password = md5($_POST['password_inp']);

        
        $query = "UPDATE `user` SET `firstname`='" . $first_name . "',`lastname`='" . $last_name . "',`mobile`='" . $mobile . "',`department`='" . $department . "'  WHERE  id = '" . $editid_inp . "'";/*
        $query = "UPDATE `user` SET `firstname`='" . $first_name . "',`lastname`='" . $last_name . "',`email`='" . $email . "',`mobile`='" . $mobile . "',`department`='" . $department . "'  WHERE  id = '" . $editid_inp . "'";*/

        $sql = mysqli_query($mycon, $query);

        if ($sql) {
            header("Location: user_details.php?msg=User Updated Successfully!");
        } else {
            $msg = "Could Not Perform the Query";
        }
		
	}


    $query =  "SELECT * FROM `user` WHERE `id`='".$_GET['editid']."'  ";
    $query_run = mysqli_query($mycon, $query);
    $data = mysqli_fetch_assoc($query_run);

	?>

	<div class="login">
		<div class="login-triangle"></div>

		<h2 class="login-header">Edit User</h2>
		<?php
		if (isset($msg)) {
			echo '<div style="background:red;color:white;padding:10px;">' . $msg . '</div>';
		}

		?>
		<form class="login-container" name="form1" action="" method="POST">
        <input type="hidden" name="editid_inp" value="<?=$_GET['editid']?>">
			<p><input type="text" placeholder="First name" required name="first_name_inp" value="<?=$data['firstname']?>"></p>
			<p><input type="text" placeholder="Last name" required name="last_name_inp"  value="<?=$data['lastname']?>"></p>
			<p><input type="Email" placeholder="Email" required name="email_inp" value="<?=$data['email']? >" readonly></p>
			<p><input type="text" placeholder="Mobile No" required name="mobile_inp" minlength="10" maxlength="10" id="mobile_inpaa"  onkeypress="return onlyNumberKey(event)" value="<?=$data['mobile']?>"></p>
			<div>
				<div>
					<div>
						<label class="login-container" name="department_inp"> Department :</label>
						<select name='department_inp' onchange="depchange(this.value)" class="selectstyle">
							
							<?php
							$dep = mysqli_query($mycon, "select * from department");
							foreach ($dep as $key => $value) {
							    ?>
                                    <option value="<?= $value['dep_id'] ?>"
                                        <?php
                                            if($data['department'] == $value['dep_id']){echo 'selected';}
                                        ?>
                                    >   
                                        <?= $value['dep_name'] ?>
                                    </option>
                                <?php } ?>
						</select>
						
					</div>
				</div>
				
			</div>


			<p> <input type="submit" name="submit1" value="Save"></p>





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

	//var p = document.getElementById("password_inpaa").value;

	//if(p.length >= 5 && p.length <= 8){
	//$("#form1").submit();
//$('form#form1').submit();
//document.getElementById("form1").submit();
var form = document.getElementById("form1");
/*form.submit();
	}else{
		alert("Password should be between 5 to 8 characters")
	}*/
}
</script>

</html>