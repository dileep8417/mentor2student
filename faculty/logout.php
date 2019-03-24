<?php
session_start();
session_destroy();
setcookie("faculty","",time()-36000,"/");
setcookie("fid","",time()-36000,"/");
setcookie("tts","",time()-36000,"/");
header("Location:../index.php");
?>