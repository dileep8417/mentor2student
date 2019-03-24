<?php
session_start();
include "../main/connection.php";
if(isset($_POST['faculty'])){
    $uname=$_POST['name'];
    $pass=$_POST['pass'];
    // function validate($data){
    //     $data = htmlspecialchars($data);
    //     $data = mysqli_real_escape_string($data);
    //         return $data;
    // }
    $query = "SELECT * FROM mentorlogin WHERE username='$uname' AND password='$pass'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
            $_SESSION['uname']=$row['username'];
            $id = $_SESSION['id'] = $_SESSION['fid']=$row['id'];
            $_SESSION['faculty']=true;
            $tts = $_SESSION['tts']=$row['ttsno'];
        }
        $check=$_POST["check"];
        if($check=="true"){
                setcookie("faculty",true,time()+3600,"/");
                setcookie("fid",$id,time()+3600,"/");
                setcookie("tts",$tts,time()+3600,"/");
        }else{
            setcookie("faculty","",time()-36000,"/");  
            setcookie("fid","",time()-36000,"/"); 
            setcookie("tts","",time()-36000,"/");
        }
        echo "success";
    }else{
       echo $uname." ".$pass;
    }
}
#--------------------------------------------

#REMOVING INTO INSTRUCTIONS 
if(isset($_GET['intro'])){
    $id=$_SESSION['id'];
    $query="UPDATE mentorlogin SET intromssg=1 WHERE id='$id'";
    $res=mysqli_query($conn,$query);
}

//UPDATING MENTOR PROFILE

if(isset($_POST["pupdate"])){
    $mail = $_POST["mail"];
    $name = $_POST["user"];
    $mobile = $_POST["contact"];
    $id=$_SESSION['id'];
    $query="UPDATE mentorlogin SET mobile='$mobile',mail='$mail',username='$name' WHERE id='$id'";
    $res=mysqli_query($conn,$query);
}

//changing pass

if(isset($_POST['upass'])){
    $pass = $_POST['newpass'];
    $id=$_SESSION['id'];
    $query="UPDATE mentorlogin SET password='$pass' WHERE id='$id'";
    $res=mysqli_query($conn,$query);
}
?>