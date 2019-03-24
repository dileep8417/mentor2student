<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php
        if(isset($_GET['id'])){
            @session_start();
            $user = $_SESSION['tts'];
            $id=$_GET['id'];
            $_SESSION['id']=$id;
            include "../main/headfiles.php";
            include "../main/connection.php";
            $query = "SELECT * FROM mentorlogin WHERE id='$id' AND ttsno='$user'";
            $res = mysqli_query($conn,$query);
            $details = mysqli_fetch_assoc($res);
            $uname=$details['ttsno'];
            $name=$details['username'];
            $mobile=$details['mobile'];
            $mail=$details['mail'];
            $profile=$details['profile'];
            if($profile=="" || $profile==null){
                $profile="../images/profile.png";
            }
    ?>
    <style>
        body{
            background:#f5f6fa;
        }
        .mentor-frame{
            width:80%;
            background:white;
            display:block;
            margin:Auto;
            padding:15px;
            border-radius:10px;
            box-shadow:2px 3px 6px black;
        }
        .profile-upload{
            width:240px;
            height:240px;
            position:relative;
        }
       table tr td{
           padding:10px;
       }
       #img{
           width:100%;
           height:100%;
       }
       table tr td:nth-child(odd){
           font-weight:bold;
       }
       table{
           padding-left:20px;
       }
       .p-window{
           position:absolute;
           top:50%;
           left:50%;
           transform:translate(-50%,-50%);
           background:white;
           z-index:10;
           display:none;
       }
       .p-window table tr{
           padding:10px;
            }
       }
    </style>

</head>
<body>
        <div class="mentor-frame">
            <h3 class="text-primary text-center mb-4">My Profile</h3>
            <div class="profile-upload" style="display:block;margin:;border-radius:7px">
                <img id="img" src="<?php echo $profile?>" alt="">
                <br>
                <button onClick="document.getElementById('file').click()" class="btn btn-warning" style="outline:none;margin-top:7px" id="upload">Upload</button><br><br>
                <input type="file" id="file" style="display:none" onchange="preview.call(this)">
            </div><br><br>

            

           <div style="display:block;margin-top:6px;;">
           <table class="col-lg-4 col-md-5 col-sm-7 col-xs-8">
                <tr>
                    <td><span><i class="fas fa-user"></i></span> Username:</td>
                    <td> <?php echo strtoupper($user)?></td>
                </tr>
                <tr>
                    <td><span><i class="fas fa-key"></i></span> Password:</td>
                    <td>****** <span><a href="#" style="padding:3px;margin-left:15px;" class="text-danger" data-id='<?php echo $id?>' onClick="pwdchg()" id="chg-pass">change</a></span></td>
                </tr>
                </table><br>

                <table class="col-lg-4 col-md-5 col-sm-7 col-xs-8">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" id="name" value="<?php echo $name?>"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="mail" id="mail" value="<?php echo $mail?>"></td>
                </tr>
                <tr>
                    <td>Mobile No.</td>
                    <td><input type="number" id="mobile" value="<?php echo $mobile?>"></td>
                </tr>
                <tr>
                    <td>Total No. of mentees</td>
                    <td>10</td>
                </tr>
            </table>
            <button class="btn btn-info" id="update-mentor-profile" style="display:block;margin:auto;margin-top:5px">Update</button>
           </div>
        </div> 
        <div class="p-window" style="width:320px;height:190px;border-radius:10px;box-shadow:1px 2px 6px black">
            <p class="close" style="float:right;position:relative;right:7px">X</p>
            <h4 class="text-danger text-center">Change Password</h4>
            <table style="padding:10px">
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" id="newpass"></td>
                    <tr>
                        <td colspan='4'><button class="btn btn-danger chg-pass-btn">Change</button></td>
                    </tr>
                </tr>
            </table>
        </div>
   <?php
        }
   ?>
    <script>
    $(document).ready(function(){
        $(".content").css("display","block");
        $(".loader").fadeOut(300);
    });

    $(".close").click(function(){
        $(".p-window").css("display","none");
    });
    $("#chg-pass").click(function(e){
        e.preventDefault();
        $(".p-window").fadeIn(300);
    });

    $(".chg-pass-btn").click(function(){
        var pass = $("#newpass").val();
        if(pass.length<=4){
            alert("Password must be more than 4 charecters");
        }else{
            $(".loader").css("display","block"); 
            $.ajax({
                    url:"logindb.php",
                    type:"POST",
                    data:{
                        newpass:pass,
                        upass:true
                    },
                    success:function(resp){
                        alert("Password Changed");
                        $(".p-window").slideUp(300);
                        $(".loader").css("display","none");
                    }
                });
        }
    });

       function preview(){
            if(this.files && this.files[0]){
                $(".loader").css("display","block");
                var obj = new FileReader();
                obj.onload=function(e){
                    var image = document.getElementById("img");
                    image.src=e.target.result;
                }
                obj.readAsDataURL(this.files[0]);

                var mprofile = $("#file")[0].files[0];
                var fd = new FormData();
                fd.append("profile",mprofile);
                    $.ajax({
                        url:"upload.php",
                        type:"POST",
                        data:fd,
                        contentType:false,
                        processData:false,
                        success:function(resp){
                            console.log(resp);
                            resp=resp.trim();
                            if(resp=="incorrect"){
                                alert("Incorrect Extention. File will not updated.");
                                $("#img").attr("src","../images/profile.png");
                            }
                            $(".loader").css("display","none");
                        }
                    });
            }
        }

        function pwdchg(){
            $(".p-window").css("display","block");
        }

        $("#update-mentor-profile").click(function(){
            var email = $("#mail").val();
            var mobile = $("#mobile").val();
            var name = $("#name").val();
            if(email.length<6 || mobile.length<10 || name.length<3){
                alert("Enter the details properly");
            }else{
                $(".loader").css("display","block");
                $.ajax({
                    url:"logindb.php",
                    type:"POST",
                    data:{
                        mail:email,
                        contact:mobile,
                        user:name,
                        pupdate:true
                    },
                    success:function(resp){
                        alert("Profile Updated");
                        $(".loader").css("display","none");
                    }
                });
            }
        });
    </script>
</body>
</html>