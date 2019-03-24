<?php
    include "../main/connection.php";

    #creating mentee profile
    if(isset($_GET['pdetails'])){
        $profile = $_GET['pdetails'];
        $vtu = strtolower($_GET['vtu']);
        $pvtu = $vtu;
        $mid = $_GET['mid'];
        $sname = $_GET['sname'];
        #CHECKING WEATHER VTU NO. IS ALREADY ADDED OR NOT
       $check = "SELECT * FROM stuprofile WHERE stuid='$vtu'";
       $cres = mysqli_query($conn,$check);
       if(mysqli_num_rows($cres)>0){
            echo "exist";
       }else{
           
           //INSERTING DATA IN MENTEE DATA
           $mquery="INSERT INTO menteedetails (sname,vtu,mentorid) VALUES ('$sname','$vtu','$mid')";
           $mres=mysqli_query($conn,$mquery);
            if($mres){

                //CREATING LOGIN FOR STUDENT
                $query = "INSERT INTO stuprofile (stuid,profileinfo,pass,mentorid) VALUES ('$vtu','$profile','$pvtu','$mid')";
                $res = mysqli_query($conn,$query);
                if($res){
                    echo "updated";
                }else{
                    echo "error";
                }
            }else{
                echo "error";
            }
           
       }
    }


    #update mentee details
    if(isset($_GET['moddetails'])){
        $profile=$_GET['moddetails'];
        $vtu = $_GET['vtu'];
        $name = $_GET['name'];
        $update = "UPDATE stuprofile SET profileinfo='$profile' WHERE stuid='$vtu'";
        $res = mysqli_query($conn,$update);
        if($res){
            $query = "UPDATE menteedetails SET sname='$name' WHERE vtu='$vtu'";
            $res2=mysqli_query($conn,$query);
            echo "success";
        }else{
            echo "err";
        }
        
    }
?>