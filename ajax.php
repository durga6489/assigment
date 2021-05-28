<?php
include "dbconnections.php";




if(isset($_POST['action']) && $_POST['action']=='department_change'){

    $des = mysqli_query($mycon, "select * from designation where dep_id='".$_POST['id']."'");
    foreach ($des as $key => $value) {
        ?>
            <option value="<?= $value['des_id'] ?>">
                <?= $value['des_name'] ?>
            </option>
        <?php
    }

}



if(isset($_POST['action']) && $_POST['action']=='email_check'){
	$email = $_POST['email_id'];
	

    $emailval ="SELECT * FROM user WHERE email = '" . $email . "'";
		$selectresult = mysqli_query($mycon, $emailval);
		$email_suffix = explode("@", $email);
        if (mysqli_num_rows($selectresult) > 0) {
			echo  1;

		}else{
			echo 0;
		}	
			




}




?>

