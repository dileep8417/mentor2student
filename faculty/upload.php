<?php
    include "../main/connection.php";
   @session_start();
   $id=$_SESSION['id'];
        if(file_exists(@$_FILES["profile"]["tmp_name"])){
            $profile=$_FILES['profile']['name'];
            $tmp=$_FILES["profile"]["tmp_name"];
            $file_name=pathinfo($profile,PATHINFO_FILENAME);
            $ext = strtoupper(pathinfo($profile,PATHINFO_EXTENSION));
            $exts = array("JPEG","JPG","PNG");
             if(in_array($ext,$exts)){
                 $file_name=$file_name.time().".".$ext;
             }else{
                 echo "incorrect";
                 die();
             }
            
             $path="facultyprofiles/".$file_name;
             $cquery = "SELECT * FROM mentorlogin WHERE id='$id'";
             $cres = mysqli_query($conn,$cquery);
             if(mysqli_num_rows($cres)>0){
                 $row=mysqli_fetch_assoc($cres);
                 unlink($row['profile']);
             }
     
             if(move_uploaded_file($tmp,$path)){
                 $query="UPDATE mentorlogin SET profile='$path'";
                 $res = mysqli_query($conn,$query);
             }
        }
?>
