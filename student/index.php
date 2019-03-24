<?php
    session_start();
    if(@$_COOKIE["student"]){
        $cokkid = $_COOKIE["id"];
        $cookstu = $_COOKIE['student'];
        $_SESSION['id'] = $cokkid;
        $_SESSION['student']=$cookstu;
    }else{
    if(!isset($_SESSION['student'])){
        header("Location:../index.php");
    }
}
    
    if(@isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        include "../main/connection.php";
        include "../main/headfiles.php";
        $query = "SELECT * FROM stuprofile WHERE id='$id'";
        $res = mysqli_query($conn,$query);
        if($res){
            $row = mysqli_fetch_assoc($res);
            $profile = $row['profileinfo'];

            #Getting mentor details
            $mid = $row['mentorid'];
            $getmentor = "SELECT * FROM mentorlogin WHERE id='$mid'";
            $mres = mysqli_query($conn,$getmentor);
            if($mres){
                $mentor = mysqli_fetch_assoc($mres);
                $_SESSION['mname']=$mentor['username'];
                $_SESSION['tts']=$mentor['ttsno'];
                $_SESSION['mid']=$mentor['id'];
            }

            $profile= json_decode($profile,true);
            $_SESSION['name']=$profile[0]['name'];
            $_SESSION['sem']=$profile[0]['sem'];
            $vtu = $_SESSION['vtu']=$profile[0]['vtu'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $profile[0]["name"]?></title>
    <style>
         @import url('https://fonts.googleapis.com/css?family=Lato|Noto+Serif');
         @import url('https://fonts.googleapis.com/css?family=Roboto+Slab');

         body{
        overflow-x:hidden;
        background:#f5f6fa;
       }
        .menu{
        position:relative;
        }
        nav{
           box-shadow:1px 2px 10px black;
       }
       .heading{
            position:relative;
            top:15vh;
            left:5vw;
            font-size:6vmin;
        }
        .nav-brand{
            font-family: 'Roboto Slab', serif !important;
            font-size:35px;
            color:#ecf0f1;
        }
        nav{
            background:#2475B0;
            padding:10px !important;
            position:fixed;
        }
        .nav-list{
            font-family: 'Arimo', sans-serif;
        }
        .nav-list a{
            color:white !important;
            margin-right:15px !important;
        }
        .list{
            line-height:25px !important;
            margin-bottom:6px !important;
        }
        
        .clicked{
            display:table-cell;
            border-bottom:3px solid orange;
            border-left:1px solid white;
            border-right:1px solid white;
            border-radius:10px;
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-md menu">
    <a href="index.php" class="nav-brand" style=" text-decoration: none;"><span style="font-weight:bolder;margin-left:15px">M</span><span style="color:#e74c3c">2</span><span style="font-weight:bolder">S</span><br>
            <p style="font-size:12px;color:white;margin-bottom:-4px;margin-top:-10px">Mentor To Student</p>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="togl" data-target="#togl">
        <span><i class="fas fa-bars"></i></span>     
		</button>
        <div class="navbar-collapse collapse" id="togl">
        <ul class="navbar-nav ml-auto">
        <li class="nav-list"><a href="index.php" id="list1"  class="nav-link list clicked">Home</a></li>
        <li class="nav-list" onClick="results()"><a href="#" id="list2"  class="nav-link list">My Results</a></li>
        <li class="nav-list" onClick='tplanner()'><a href="#" id="list3" class="nav-link list" >Enroll Courses</a></li>
        <li class="nav-list" onClick="mytimetable()"><a href=# id="list4"  class="nav-link list">My Timetable</a></li>
        <li class="nav-list" onClick="profile()"><a href="#" id="list5" class="nav-link list">Profile</a></li>
        <li class="nav-list"><a href="logout.php" id="list6" class="nav-link list">Logout</a></li>
    </ul>
        </div>
    </nav>
    <img src="../images/spinner.gif" class="loader" style="width:13vw;min-width:125px;position:absolute;top:50vh;left:50%;transform:translateX(-50%);z-index:1000;display:" alt="">
        <!-----Search Faculty----->
            <div class="faculty-search-holder" style="position:absolute;right:10px;margin-top:15px;padding:15px;z-index:10">
    
                 <input type="text" id="search-fac" value='<?php echo @$_SESSION['search']?>' style="width:15vw;min-width:200px;margin-top:-40px;border-radius:5px;height:30px;padding-left:5px;border:.5px solid grey;outline:none;" placeholder="Search Faculty">
                    <button class="btn btn-info" style="margin-top:0px;border-radius:3px;width:90px;padding:3px;position:relative;top:-2px" id="search-btn">Search</button>
            </div>
        <!---content-->
        <div class="container-fluid main">
            <div class="row">
                <div class="content">
                   
                </div>
            </div>
        </div>
    <script>
        $(window).ready(function(){
            $(".loader").fadeOut(300);
        });
         $(".list").click(function(){
            $(".list").removeClass("clicked");
            var id = $(this).attr("id");
            $("#"+id).addClass("clicked");
            $(".navbar-toggler").click();
        });
        //time table planner
        function tplanner(){
            $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".content").load("timetable/index.php");
        }
        //Sem Results
        function results(){
            $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".content").load("../faculty/semresults.php?vtu=<?php echo $vtu?>&student=1");
        }
        //timetable
        function mytimetable(){
            $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".content").load("timetable/timetable.php");
        }
        //Profile Details
        function profile(){
            $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".content").load("../faculty/studentprofile.php?vtu=<?php echo $vtu?>&student=1");
        }
    </script>
</body>
</html>