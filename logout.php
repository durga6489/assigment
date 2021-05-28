<?php

session_start();
session_destroy();


?>
<script type="text/javascript">
// header("Location: index.php?status=User Registered Successfully!");
window.location="index.php?status=Logged out Successfully!";
</script> 