<?php
include "dbconnections.php";




if(isset($_POST['action']) && $_POST['action']=='state_change'){

    $des = mysqli_query($mycon, "select * from cities where state_id='".$_POST['id']."'");
    foreach ($des as $key => $value) {
        ?>
            <option value="<?= $value['city_id'] ?>">
                <?= $value['city_name'] ?>
            </option>
        <?php
    }

}

?>