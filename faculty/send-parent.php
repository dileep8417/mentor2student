<?php
    include "../main/connection.php";
    @session_start();
    $mid = $_SESSION['id'];
    if(isset($_GET['sendres'])){
        $vtu = $_GET['vtu'];
        $sem = $_GET['sem'];
        $query = "SELECT * FROM menteedetails WHERE vtu='$vtu' AND mentorid='$mid'";
        $res = mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            while($row = mysqli_fetch_assoc($res)){
                $marks = $row["sem".$sem];
                if($marks=="" || $marks==null){
                    echo "results empty";
                }
                else{
                    $marks = json_decode($marks,true);
                    $checkpmail = "SELECT * FROM stuprofile WHERE stuid='$vtu'";
                    $res2 = mysqli_query($conn,$checkpmail);
                    if(mysqli_num_rows($res2)>0){
                        while($p = mysqli_fetch_assoc($res2)){
                            $profile = $p['profileinfo'];
                            $profile = json_decode($profile,true);
                            $mail=$profile[0]["parentmail"];
                            $name = $profile[0]['name'];
                            if($mail=="" || $mail==null){
                                echo "mail empty";
                            }else{
                                //sending results table
                                $l = count($marks);
                                $sname = $name;
                                $svtu = $vtu;
                                $semester = "Semester-".$sem;
                                //Creating Table
                                $msg ="
                                <div class='img'><img src='https://www.veltech.edu.in/wp-content/uploads/2018/12/rwamp_logo_v2.png' alt='logo' style='width: 400px;display: block;margin: auto;'></div>
                                <center><h2 class='head' style='text-align: center;font-size: 22px !important;'>Semester results of your child <span class='sname' style='color: blue;'>$sname</span></h2>
                                <table class='table' style='width: 70%;position: relative;border-radius:3px;;left: 50%;transform: translateX(-50%);padding: 10px;font-size: 22px;'>
                                    <tr>
                                        <th style='background: #e55039;color: white;padding: 10px;min-width: 200px;'>Subject Name</th>
                                        <th style='background: #e55039;color: white;padding: 10px;min-width: 200px;'>Grade</th>
                                    </tr>
                                    ";
                                    for($i=0;$i<$l-1;$i++){
                                        $sub = $marks[$i]['subject'];
                                        $grd = $marks[$i]['grade'];
                                        $msg .= "<tr>
                                        <td style='border:1px solid black;'>$sub</td>
                                        <td style='border:1px solid black;text-align:center'>$grd</td>
                                    </tr>
                                        ";
                                    }
                                    $l=$l-1;
                                    $sub = $marks[$l]['subject'];
                                    $grd = $marks[$l]['grade'];
                                    $msg .= "
                                            <tr>
                                                <td style='border:1px solid black;'>$sub</td>
                                                <td style='border:1px solid black;text-align:center'>$grd</td>
                                            </tr>
                                            </table></center>
                                    ";
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                if(mail($mail,"Veltech Semester Results",$msg,$headers)){
                                    echo "mail sent";
                                }else{
                                    echo "mail not sent";
                                }
                            }
                        }
                    }
                }
            }
        }
        else{
            echo "Something wrong...";
        }
    }
?>

