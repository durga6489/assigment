<?php
session_start();
include "dbconnections.php";

if (!isset($_SESSION["user_id"])) {

header("Location: index.php");
}



if (isset($_GET['delid'])) {


    echo "durga";

    

    
    $query = "DELETE FROM `user` WHERE id='".$_GET['delid']."'";

    $sql = mysqli_query($mycon, $query);

    if ($sql) {
        $successmsg = "User deleted successfully!";
    } 
    
}
?>



 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <title>User Details</title>

     <style>
         body{
            margin: 0 !important;
            padding: 0;
         }
         table {
             margin: 0 auto;
             font-size: large;
             border: 1px solid black;
         }

         .msgbox{
             margin: 0 auto;
             font-size: large;
             border: 1px solid black;
         }

         h1 {
             text-align: center;
             color: #006600;
             font-size: xx-large;
             font-family: 'Gill Sans', 'Gill Sans MT',
                 ' Calibri', 'Trebuchet MS', 'sans-serif';
         }

         td {
             background-color: #E4F5D4;
             border: 1px solid black;
         }

         th,
         td {
             font-weight: bold;
             border: 1px solid black;
             padding: 10px;
             text-align: center;
         }

         td {
             font-weight: lighter;
         }
     </style>
 </head>

 <body>
     <div style="position:absolute;top:0px;width:100%;height:50px;background:#465768;color:white;padding:4px;margin:3px;">
     <div style="position:absolute;top:0px;right:0px;color:white;padding:4px;margin:3px;">
         <i>Hello, <?=$_SESSION["user_firstname"]?></i>

         <button style="background:red;color:white;padding:4px;margin:3px;" onclick="window.location.href='logout.php'">Logout</button>
     </div>
     
    </div>
    <br>
    <br>
    <br>
     <section>
     <?php
		if (isset($msg)) {
			echo '<div style="background:red;color:white;padding:10px;">' . $msg . '</div>';
		}elseif (isset($_GET['msg'])) {
			echo '<div style="background:green;color:white;padding:10px;" class="msgbox">' . $_GET['msg'] . '</div>';
		}elseif (isset($successmsg)) {
			echo '<div style="background:green;color:white;padding:10px;" class="msgbox">' . $successmsg . '</div>';
		}

		

		?>
         <h1>User Details</h1>

         <table>
             <tr>
                 <th>Sr.NO.</th>
                 <th>Name</th>
                 <th>Email</th>
                 <th>Mobile No.</th>
                 <th>Department</th>

                 <?php
                    if ($_SESSION["user_role"] == 1) {
                    ?><th>Action</th><?php
                                    }
                                        ?>


             </tr>

             <?php
                $dep = mysqli_query($mycon, "select *,department.dep_name from user inner join department on dep_id=user.department");
                while ($rows = mysqli_fetch_assoc($dep)) {
                ?>
                 <tr>
                     <td><?php echo $rows['id']; ?></td>
                     <td><?php echo $rows['firstname']; ?></td>
                     <td><?php echo $rows['email']; ?></td>
                     <td><?php echo $rows['mobile']; ?></td>
                     <td><?php echo $rows['dep_name']; ?></td>
                     <?php
                        if ($_SESSION["user_role"] == 1) { ?>
                         <td>
                             <a href="edit.php?editid=<?php echo $rows['id']; ?>">Edit</a> |
                             <button onclick="deluser(this.value)" value="<?php echo $rows['id']; ?>">Delete</button>
                         </td>

                         
                     <?php
                        }
                    ?>


                 </tr>
             <?php
                }
                ?>
         </table>
     </section>
 </body>
 <script>

     function deluser(id){
         if(confirm('Are you sure to delete user?')){
             window.location.href="user_details.php?delid=" + id;
         }
     }
 </script>
 </html>