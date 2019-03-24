<?php
    @session_start();
    if(@isset($_SESSION["student"])){
        header("Location:student/index.php");
    }else{
        if(isset($_COOKIE['student'])){
            header("Location:student/index.php");
        }
    }
    if(@isset($_SESSION["faculty"])){
        header("Location:faculty/index.php");
    }else{
        if(isset($_COOKIE['faculty'])){
            header("Location:faculty/index.php");
        }
    }
    if(@isset($_SESSION['tmpstuid'])){
        $tid=$_SESSION['tmpstuid'];
        ?>
        <script>
            var tid="<?php echo  $tid?>";
        </script>
        <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>M2S</title>
    <?php include "main/headfiles.php"?>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Merriweather');

       .info{
             position:relative;
           top:10vh;
           left:0px;
           font-size: 4vmin;
           display:block;
           margin:auto;
           float:left;
          
       }
       body{
          background:#f5f6fa;
       }
       #student-login,#faculty-login{
        width:440px;
        height:300px;
        background:white;
        box-shadow:4px 5px 8px black; 
        display:block;
        margin:auto;
        margin-top:20vh;
        position: relative;
        border-radius:10px;
       overflow: hidden;
    }
    #faculty-login .side-color{
        background:#2196F3 !important;
    }
    .side-color{
        position: absolute;
        height:100%;
        width:100px;
        background: #FF9800;
        color:white;
        font-family: 'Merriweather', serif;
        left:0px;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px; 
        box-shadow:4px 5px 12px black;  
    }
    .side-color p{
        position: relative;
        top:50%;
        transform: translateY(-50%);
        padding:12px;
    }
    .login-body{
        padding:25px;
    }
    #student-login input,#faculty-login input{
        position: relative;
        width:80%;
        display: block;
        margin:auto;
        left:50px;
        border:.5px solid #FF9800;
        border-radius:8px;
        padding-left: 6px;
        padding:4px;
        outline:none;
    }
    #student-login .btm-dec{
        background: #2196F3 !important;
    }
    .btm-dec{
        width:100px;
        height:100px;
        background: orange;
        transform: rotate(199deg);
        float:right;
        position:relative;
        right:-40px;
        box-shadow:4px 5px 12px black; 
        top:-40px;
    }
    #student-login input:nth-child(1),#faculty-login input:nth-child(1){
        margin-top:20px;
    }
    @media(max-width:450px){
        #student-login,#faculty-login{
            width:100%;
        }
        #s-login,#f-login{
            margin-top:20px !important;
        }
    }
      
    </style>
</head>
<body>
    <?php include "main/header.php"?>
    <img src="images/spinner.gif" style="display:none;position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)" alt="" class="loader">
    <div class="container">
        <div class="row">
            <div class="info col-md-5 col-lg-5 col-xs-12 col-sm-12">
                    <p class="" style="color:orange;font-weight:bold;font-size: 5vmin;margin-bottom:-3px">About</p>
                <p>Mentor to Student is a platform where it connects the mentor and student through online and make their work some more easier.</p>
            </div>
        <div class="login-holder col-md-7 col-lg-5 col-xs-12 col-sm-12">
            <?php include "main/studentlogin.php"?>
        </div>
    </div>
 </div>
    <!-- BUTTONS -->
   
       
       <script>
           //Faculty login

           function flogin(){
                $(".login-holder").load("main/facultylogin.php");
            }
            function slogin(){
                $(".login-holder").load("main/studentlogin.php");
            }

           function faclogin(){
                var uname = $("#fac-id").val();
                var upass = $("#fac-pass").val();
                if(document.getElementById("rem-fac").checked==true){
                    var ccheck="true";
                }else{
                    var ccheck="false";
                }
                if(uname.length<4 || upass.length<4){
                    alert("Enter valid details");
                }else{
                    $.ajax({
                        url:"faculty/logindb.php",
                        type:"POST",
                        data:{
                            faculty:true,
                            name:uname,
                            pass:upass,
                            check:ccheck
                        },
                        success:function(resp){
                            console.log(resp)
                            var msg = resp;
                            if(msg=="success"){
                                location.href="faculty/index.php";
                            }else{
                                alert("Username or Password not valid");
                                $("#fac-id").val("");
                            }
                        }
                    });
                }
            }


            //student login

            function stulogin(){
                var uname = $("#stu-id").val();
                var upass = $("#stu-pass").val();
                if(document.getElementById("rem-stu").checked==true){
                   var ccheck="true";
                }else{
                   var ccheck="false";
                }
                if(uname.length<7 || uname.length>8 || upass.length<4){
                    alert("Enter valid details");
                }else{
                    $.ajax({
                        url:"student/verify.php",
                        type:"POST",
                        data:{
                            student:true,
                            name:uname,
                            pass:upass,
                            check:ccheck
                        },
                        success:function(resp){
                            var msg = resp.trim();
                            if(msg=="invalid details"){
                                alert("Enter valid details");
                            }else if(msg=="invalid entry"){
                                alert("Username or Password is not correct");
                            }else if(msg=="pass not changed"){
                                $(".container").css("display","none");
                                $(".loader").css("display","block");
                               $(".container").load("student/changepass.php?vtu="+uname);
                            }else if(msg=="pass changed"){
                                location.href="student/index.php";
                            }
                        }
                    });
                }
            }
       </script>
    
    
</body>
</html>