<?php
session_start();
session_destroy();
setcookie("student","",time()-36000,"/");
setcookie("id","",time()-36000,"/");
header("Location:../index.php");
?>