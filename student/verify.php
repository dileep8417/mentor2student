<?php
    @session_start();
    include "../main/connection.php";
    //checking student details and checking password is changed or not
    if(isset($_POST['student'])){
        $uname = strtolower($_POST['name']);
        $pass = $_POST['pass'];
        if(strlen($uname)<7 || strlen($uname)>8 || strlen($pass)<4){
                echo "invalid details";
        }else{
            $query = "SELECT * FROM stuprofile WHERE stuid='$uname' AND pass='$pass'";
            $res = mysqli_query($conn,$query);
            if(mysqli_num_rows($res)>0){
                $row=mysqli_fetch_assoc($res);
                $pcheck = $row['pwdchg'];
                $sid = $row['id'];
                $_SESSION['tmpstuid']=$sid;
                if($pcheck==0){
                    echo "pass not changed";
                }else{
                    $ck=$_POST["check"];
                    if($ck=="true"){
                        setcookie("id",$sid ,time()+3600,"/");
                        setcookie("student",true,time()+3600,"/");
                    }else{
                        setcookie("id","" ,time()-36000,"/");
                        setcookie("student","",time()-36000,"/");
                    }
                    echo "pass changed";
                    $_SESSION['id']=$row['id'];
                    $_SESSION['user']=$row['stuid'];
                    $_SESSION['mentorid']=$row['mentorid'];
                    $_SESSION["student"]=true;
                    }
            }else{
                echo "invalid entry";
            }
        }
    }

    if(isset($_POST['changepass'])){
        $pass=$_POST['pass'];
        $vtu = $_POST['vtu'];
        $pass=htmlspecialchars($pass);
        if(strlen($pass)<4){
            echo "err";
        }else{
            $query = "UPDATE stuprofile SET pass='$pass',pwdchg=1 WHERE stuid='$vtu'";
            $res = mysqli_query($conn,$query);
            if($res){
                echo "changed";
            }else{
                echo "err";
            }
        }
    }

?>