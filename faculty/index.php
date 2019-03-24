<?php
session_start();
#RETURNING TO LOGIN PAGE
if(isset($_COOKIE["faculty"])){
    $cookid = $_COOKIE['fid'];
    $cooktts = $_COOKIE['tts'];
    $_SESSION['id']=$cookid;
    $_SESSION['tts']=$cooktts;
}else{
    if(!isset($_SESSION['faculty'])){
        header("Location:index.php");
        die();
    }
}
$mid = $_SESSION['id'];
include "../main/connection.php";
$id = $_SESSION['id'];
$query = "SELECT * FROM mentorlogin WHERE id='$id'";
$res=mysqli_query($conn,$query);
if(mysqli_num_rows($res)>0){
    while($row=mysqli_fetch_assoc($res)){
        $_SESSION['intro']=$row['intromssg'];
        $_SESSION['uname']=$row['username'];
        $_SESSION['tts'] = $row['ttsno'];
         
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <title><?php echo @$_SESSION['uname']?></title>
    <style>
  @import url('https://fonts.googleapis.com/css?family=Lato|Noto+Serif');
  @import url('https://fonts.googleapis.com/css?family=Roboto+Slab');
    .main{
        width:100%;
    }
    *{
        box-sizing:border-box;
        margin:0px;
        padding:0px;
    }
    body{
        overflow-x:hidden;
        background:#f5f6fa;
    }
    .navbar{
           background: #2196F3;
       }
       nav{
           box-shadow:1px 2px 10px black;
       }
    .nav-brand{
        font-family: 'Roboto Slab', serif !important;
        font-size:35px;
        color:#ecf0f1;
    }
   .intro{
            width:100vw;
            height:80vh;
            background:#130f40;
            position:absolute;
            z-index:1000;
            animation:anime1 1s linear;
            color:white;
            border-radius:10px;
      }
     .heading{
            position:relative;
            top:15vh;
            left:5vw;
            font-size:6vmin;
        }
     .intro h3,.lead{
            position:relative;
            top:18vh;
            left:2vw;
            font-size:3vmin;
        }
      #intro-close{
            cursor:pointer;
        }
      .intro-btn1{
            position:relative;
            top:45% !important;
           display: block !important;
           margin: auto !important;
        }
      .intro-btn2{
            position:relative;
            top:26%;
            display: block;
           text-align: center;
        }
      .dont-show:hover{
            background:none !important;
        }
        .update-student{
            display:none;
        }
        @media(min-width:760px){
            .intro{
                width:60vw;
                top:50%;
                left:50%;
                transform:translate(-50%,-50%);
            }
        }
        @media(max-width:760px){
            .intro{
                height:100vh;
                width:100vw;
            }
        }
        @keyframes anime1{
            from{top:-100%}
        }
        @keyframes anime2{
            from{top:50%}
            to{top:-100%}
        }
    .menu{
        position:relative;
    }
    nav{
        background:#2475B0;
        padding:10px !important;
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
    .content{
        width:100%;
        height:auto;
        position:relative;
        top:100px;
        margin-bottom:40px;
        display:none;
    }
    .loader{
        display:block;
    }
    .features{
        position:relative;
        top:15px;
        width:100vw;
        padding:15px;
    }
    .features a{
        text-decoration:none;
    }
    .re-reg-holder,.faculty-courses,.mentor-profile-holder,.mentor-timetable-holder,.pmail-holder,.modify-res-holder,.stu-profile-holder,.stu-achive-holder,.help-window,.forms-holder{
        width:20vw;
        min-width:180px;
        height:28vh;
        position:relative;
        border-radius:10px;
        box-shadow:1px 2px 3px black;
        transition:all 1s;
        overflow:hidden;
        cursor:pointer;
    }
    .re-reg-holder p,.faculty-courses p,.mentor-profile-holder p,.pmail-holder p,.mentor-timetable-holder p,.modify-res-holder p,.stu-profile-holder p,.stu-achive-holder p,.help-window p,.forms-holder p{
        position:relative;
        font-size:23px;
    }
    .re-reg-holder:hover .icon span,.faculty-courses:hover .icon span,.mentor-profile-holder:hover .icon span,.mentor-timetable-holder:hover .icon span,.pmail-holder:hover .icon span,.stu-achive-holder:hover .icon span,.modify-res-holder:hover .icon span,.stu-profile-holder:hover .icon span,.help-window:hover .icon span,.forms-holder:hover .icon span{
        position:relative;
       font-size:90px !important;
    }
   .close{
       cursor:pointer;
   }
   .update-res,.send-student-res{
       display:none;
   }
    @media(max-width:575px){
        .features .re-reg-holder,.mentor-profile-holder,.faculty-courses,.mentor-timetable-holder,.pmail-holder,.modify-res-holder,.stu-profile-holder,.stu-achive-holder,.help-window,.forms-holder{
            display:block;
            margin:auto;
            width:250px;
        }

    }
    </style>
</head>

<body>
<div class="intro">
        <span id="intro-close" style="float:right;position:absolute;right:20px;font-size:25px">X</span>
            <h1 class="heading text-warning">Mentor Management System</h1>
            <h3>Instructions</h3>
            <p class="lead"><span class="text-primary">STEP-1:- </span>Add Your Mentees From <span class="text-info">ADD MENTEE</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-2:- </span>You Can Find Your Mentees From <span class="text-info">MY MENTEE</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-3:- </span>Update Your Mentees Marks From <span class="text-info">MANAGE RESULTS</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-4:- </span>You Can Find All Your Mentees Details From <span class="text-info">ADD MENTEE</span> Section</p>
            <a href="#" class="text-warning dont-show intro-btn2">Don't show this again</a>
        </div>
<!------------------------------------------------------------------------------->

<!----------------------------MENU------------------------------------------------------>
    <nav class="navbar navbar-expand-md menu" id="top">
    <a href="index.php" class="nav-brand" style=" text-decoration: none;"><span style="font-weight:bolder;margin-left:15px">M</span><span style="color:#e74c3c">2</span><span style="font-weight:bolder">S</span><br>
            <p style="font-size:12px;color:white;margin-bottom:-4px;margin-top:-10px">Mentor To Student</p>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="togl" data-target="#togl">
        <span><i class="fas fa-bars"></i></span>     
		</button>
        <div class="navbar-collapse collapse" id="togl">
        <ul class="navbar-nav ml-auto">
        <li class="nav-list"><a href="index.php" id="list1"  class="nav-link list clicked">Home</a></li>
        <li class="nav-list"><a href="#" id="list2" onClick="addMentee()" class="nav-link list">Add Mentee</a></li>
        <li class="nav-list"><a href="#" id="list3" onClick="results()" class="nav-link list" >Manage results</a></li>
        <li class="nav-list"><a href="#" id="list4" onClick="mymentee()" class="nav-link list">My Mentees</a></li>
        <li class="nav-list"><a href="logout.php" id="list6" class="nav-link list">Logout</a></li>
    </ul>
        </div>
    </nav>
<!---------------------------------------------------------------------------------------------------->
        <img src="images/spinner.gif" class="loader" alt="" style="width:13vw;min-width:125px;position:absolute;top:50vh;left:50%;transform:translateX(-50%);z-index:1000;display:">
<!----------------------------------------SEARCH------------------------------------------------------------>
<div class="mentee-search-holder" style="position:absolute;right:10px;margin-top:15px;padding:15px;z-index:10">
    
    <input type="text" id="search-vtu" value='<?php echo @$_SESSION['search']?>' style="width:15vw;min-width:200px;margin-top:-40px;border-radius:5px;height:30px;padding-left:5px;border:.5px solid grey;outline:none;" placeholder="Search through VTU No.">
     <select name="" id="search-sem" style="margin-top:5px;border-radius:5px;height:30px;outline:none;">
            <option value="">Select semester</option>
                    <?php
                        for($i=1;$i<=8;$i++){
                            ?>
                            <option value="<?php echo $i?>">Semester-<?php echo $i?></option>
                            <?php
                        }
                    ?>
     </select>
   <button onClick="search()" style="margin-top:4px;border-radius:3px;width:90px;padding:2px" class="btn-primary text-white">Search</button>
</div><br>

<!------------------------------------------------------HOLDER-------------------------------------------------->
        <div class="container-fluid">
            <div class="row">
                <div class="content">
                <h2 class="text-warning" style="padding-left:25px;margin-bottom:-10px">General Apps</h2>
                    <div class="container-fluid">
                        <div class="row">
                            
                            <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                <a href="#top"><div class="mentor-profile-holder" style="background:#f9ca24">
                                    <div class="icon" class="" style="text-align:center;">
                                            <span class="text-white" style="font-size:65px;"><i class="fas fa-user-circle"></i></span>
                                        </div>                            
                                        <p class="text-white text-center" style="position:relative;">My Profile</p><br>
                                    </div></a>
                                </div>

                                <div class="features col-lg-3 col-md-4 col-xs-12 col-sm-4" id="u-s-info">
                                    <a href="#top"><div class="forms-holder" style="background:#e74c3c">
                                            <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-download"></i></span>
                                            </div>
                                        <p class="text-white text-center">Download Forms</p>
                                        </div></a>
                                </div>
                        </div>
                    </div> <br><br>

                    <!-------Mentor features---------->
                    <h2 class="text-warning" style="padding-left:25px;margin-bottom:-10px">Mentor Apps</h2>
                        <div class="container-fluid">
                            <div class="row">

                                <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                    <a href="#top"><div class="pmail-holder" style="background:#ff6b6b">
                                        <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-envelope"></i></span>
                                            </div>                            
                                            <p class="text-white text-center" style="position:relative;">Send results to parents</p><br>
                                        </div></a>
                                </div>

                                <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                    <a href="#top"><div class="re-reg-holder bg-primary" style="">
                                        <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-envelope"></i></span>
                                            </div>                            
                                            <p class="text-white text-center" style="position:relative;">Course Re-Registration</p><br>
                                        </div></a>
                                </div>

                                 <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                        <a href="#top"><div class="stu-achive-holder" style="background:#27ae60">
                                        <div class="icon" class="" style="text-align:center;">
                                            <span class="text-white" style="font-size:65px;"><i class="fas fa-award"></i></span>
                                        </div>
                                            <p class="text-white text-center" style="position:relative;">Student achievements</p><br>
                                        </div></a>
                                 </div>

                                <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                    <a href="#top"><div class="modify-res-holder" style="background:#FF9800">
                                            <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-poll"></i></span>
                                            </div>
                                            <p class="text-white text-center">Modify results</p>
                                    </div></a>
                                </div>
                
                                <div class="features col-lg-3 col-md-4 col-xs-12 col-sm-4" id="u-s-info">
                                    <a href="#top"><div class="stu-profile-holder" style="background:#9C27B0">
                                            <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-user-edit"></i></span>
                                            </div>
                                        <p class="text-white text-center">Update student info</p>
                                        </div></a>
                                </div>

                                <div class="features col-lg-3 col-md-4 col-xs-12 col-sm-4">
                                    <a href="#top"><div class="help-window" style="background:#03a9f4" onClick="popupintro()">
                                            <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-question-circle"></i></span>
                                            </div>
                                        <p class="text-white text-center">Help</p>
                                    </div></a>
                                </div>

                            </div>
                        </div><br><br>
                        <!------------------------------------------------------>

                        <!-------------------------Faculty Features------------------------------>

                    <h2 class="text-warning" style="padding-left:25px;margin-bottom:-10px">Faculty Apps</h2>
                    <div class="container-fluid">
                        <div class="row">
                            
                            <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                    <a href="#top"><div class="mentor-timetable-holder" style="background:#22a6b3">
                                        <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="far fa-calendar-alt"></i></span>
                                            </div>                            
                                            <p class="text-white text-center" style="position:relative;">My Timetable</p><br>
                                    </div></a>
                             </div>

                            <div class="features col-lg-3 col-md-4 col-xs-6 col-sm-4">
                                <a href="#top"><div class="faculty-courses" style="background:#4cd137">
                                    <div class="icon" class="" style="text-align:center;">
                                            <span class="text-white" style="font-size:65px;"><i class="fas fa-book-open"></i></span>
                                        </div>                            
                                        <p class="text-white text-center" style="position:relative;">Handling Courses</p><br>
                                    </div></a>
                                </div>

                                <div class="features col-lg-3 col-md-4 col-xs-12 col-sm-4" id="u-s-info">
                                    <a href="#top"><div class="forms-holder" style="background:#e74c3c">
                                            <div class="icon" class="" style="text-align:center;">
                                                <span class="text-white" style="font-size:65px;"><i class="fas fa-download"></i></span>
                                            </div>
                                        <p class="text-white text-center">Download Forms</p>
                                     </div></a>
                                </div>

                        </div>
                    </div>
                        <!---------------------------------------------------------------->
                </div>                        
             </div>
        </div>
                <!--result modification-->
             <div class="update-student" style="position:absolute;width:350px;height:200px;background:white;border-radius:10px;box-shadow:1px 1px 3px black;top:50%;left:50%;transform:translate(-50%,-50%);z-index:400">
                            <div class="close" style="float:right;mrgin-right:15px;padding:10px;">X</div>
                            <h4 class="text-warning text-center" style="padding:15px">Update Mentee Profile</h4>
                            <div class="modbody text-center" style="display:block;margin:auto;position:relative;top:20px">
                                    <?php include "../main/connection.php";
                                    @session_start();
                                    $id=$_SESSION['id'];
                                        $query = "SELECT * FROM menteedetails WHERE mentorid='$id'";
                                        $res = mysqli_query($conn,$query);
                                        ?>
                                            <select name="" id="mvtu" style="width:80%;min-width:300px;border-radius:5px;outline:none">
                                            <option value="">Choose Mentee</option>
                                        <?php
                                        if($res){
                                            while($row=mysqli_fetch_assoc($res)){
                                                $vtu = $row['vtu'];
                                                ?>
                                                    <option value="<?php echo $vtu?>"><?php echo $vtu?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                        <?php
                                    ?>
                                    <button class="btn btn-primary" id="uprofile-btn" style="display:block;margin:auto;margin-top:12px">Proceed</button>
                            </div>
                        </div>
<!------------------------------------------------------------------------->

                    <div class="update-res" style="position:absolute;width:350px;height:200px;background:white;border-radius:10px;box-shadow:1px 1px 3px black;top:50%;left:50%;transform:translate(-50%,-50%);z-index:400">
                            <div class="close" style="float:right;mrgin-right:15px;padding:10px;">X</div>
                            <h4 class="text-info text-center" style="padding:15px">Modify Mentee Results</h4>
                            <div class="modresbody" style="position:relative;top:4px;padding:10px">
                                    <?php include "../main/connection.php";
                                    @session_start();
                                    $id=$_SESSION['id'];
                                        $query = "SELECT * FROM menteedetails WHERE mentorid='$id'";
                                        $res = mysqli_query($conn,$query);
                                        ?>
                                    <select name="" id="vturm" style="width:48%;min-width:150px;border-radius:5px;outline:none;float:left;margin-right:4px;margin-left:4px;height:30px">
                                            <option value="">Choose Mentee</option>
                                        <?php
                                        if($res){
                                            while($row=mysqli_fetch_assoc($res)){
                                                $vtu = $row['vtu'];
                                                ?>
                                                    <option value="<?php echo $vtu?>"><?php echo $vtu?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </select>

                                        <select name="" id="semres" style="width:48%;min-width:150px;border-radius:5px;outline:none;float:left;margin-left:4px;height:30px">
                                            <option value="">Select semester</option>
                                            <?php
                                                for($i=1;$i<=8;$i++){
                                                    ?>
                                                    <option value="<?php echo $i?>">Semester-<?php echo $i?></option>
                                                    <?php
                                                }
                                            ?>
                                      </select><br>
                                        <?php
                                    ?>
                                    <button class="btn btn-primary" id="ures-btn" style="display:block;margin:auto;margin-top:16px">Proceed</button>
                            </div>
                        </div>
                        
                    <!------------------SEND RESULTS----------------------->

                    <div class="send-student-res" style="position:absolute;width:350px;height:200px;background:white;border-radius:10px;box-shadow:1px 1px 3px black;top:50%;left:50%;transform:translate(-50%,-50%);z-index:400">
                        <div class="close" style="float:right;margin-right:7px;padding:10px;">X</div>
                            <h4 class="text-success text-center" style="padding:15px">Send Results To Parents</h4>
                            <div class="modresbody" style="position:relative;top:4px;padding:10px">
                                    <?php include "../main/connection.php";
                                    @session_start();
                                    $id=$_SESSION['id'];
                                        $query = "SELECT * FROM menteedetails WHERE mentorid='$id'";
                                        $res = mysqli_query($conn,$query);
                                        ?>
                                    <select name="" id="send-vtu" style="width:48%;min-width:150px;border-radius:5px;outline:none;float:left;margin-right:4px;margin-left:4px;height:30px">
                                            <option value="">Choose Mentee</option>
                                        <?php
                                        if($res){
                                            while($row=mysqli_fetch_assoc($res)){
                                                $vtu = $row['vtu'];
                                                ?>
                                                    <option value="<?php echo $vtu?>"><?php echo $vtu?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                        <select name="" id="send-sem" style="width:48%;min-width:150px;border-radius:5px;outline:none;float:left;margin-left:4px;height:30px">
                                            <option value="">Select semester</option>
                                            <?php
                                                for($i=1;$i<=8;$i++){
                                                    ?>
                                                    <option value="<?php echo $i?>">Semester-<?php echo $i?></option>
                                                    <?php
                                                }
                                            ?>
                                      </select><br>
                                        <?php
                                    ?>
                                    <button class="btn btn-success" id="send-res-btn" style="display:block;margin:auto;margin-top:16px">Send</button>
                            </div>
                     </div>
                <!--------------------------------------------------------------------------------------->

   <!--Script files-->
   <script>
    var showIntroPopup='<?php echo $_SESSION['intro']?>';
    if(showIntroPopup==1){
        $(".intro").css("display","none");
    }

   $("#intro-close").click(function(){
       $(".intro").fadeOut(500);
   });

   $(".understand").click(function(){
       $(".intro").fadeOut(500);
   });

   $(".dont-show").click(function(){
      var xhr = new XMLHttpRequest();
      xhr.open("GET","logindb.php?intro=1",false);
      xhr.send(null);
      showIntroPopup=1;
      $(".intro").fadeOut(500);
   });

   function popupintro(){
    $(".intro").css("display","block");
   }

   $(".close").click(function(){
        $(".update-student").slideUp(300);
        $(".update-res").slideUp(300);
        $(".send-student-res").slideUp(300);
    });

    //Mentor Profile

    $(".mentor-profile-holder").click(function(){
        $(".content").css("display","none");
        $(".loader").css("display","block");
        $(".content").load("mentorprofile.php?id=<?php echo $id?>");
    });

//update profile
   $(".stu-profile-holder").click(function(){
        $(".update-student").fadeIn(300);
   });

   $("#uprofile-btn").click(function(){
        var mvtu =$("#mvtu").val();
        if(mvtu.length<3){
            alert("Enter proper details");
        }else{
            $(".update-student").slideUp(300);
            $(".content").css("display","none");
             $(".loader").css("display","block");
             $(".content").load("addmentee.php?modify="+mvtu);
        }
   });
//---------------------------------------

//modify results
    $(".modify-res-holder").click(function(){
        $(".update-res").fadeIn(300);
   });

   $("#ures-btn").click(function(){
       var vtu = $("#vturm").val();
       var sem = $("#semres").val();
       if(vtu=="" || sem==""){
            alert("Select the details...");
       }else{
           $(".update-res").slideUp(300);
           $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".content").load("results.php?resmodify=1&vtu="+vtu+"&sem=sem"+sem);
       }
   });
//-------------------------------------------

   //send result
$(".pmail-holder").click(function(){
    $(".send-student-res").fadeIn(300);
});

   $("#send-res-btn").click(function(){
       var vtu = $("#send-vtu").val();
       var sem = $("#send-sem").val();
       if(vtu=="" || sem==""){
            alert("Select the details...");
       }else{
           $(".send-student-res").slideUp(300);
           $(".content").css("display","none");
            $(".loader").css("display","block");
            $.ajax({
                url:"send-parent.php?sendres=1&vtu="+vtu+"&sem="+sem,
                type:"GET",
                success:function(resp){
                    var r=resp.trim();
                    if(r=="results empty"){
                        alert("Selected semester results not added.");
                    }
                    if(r=="mail empty"){
                        alert("Parent mail-Id not found.");
                    }
                    if(r=="mail sent"){
                        alert("Mail sent");
                    }
                    if(r=="mail not sent"){
                        alert("Mail not sent");
                    }
                    $(".content").css("display","block");
                     $(".loader").fadeOut(300);
                }
            });
       }
   });
</script>

    <script>
        function mymentee(){
            $(".content").css("display","none");
             $(".loader").css("display","block");
            var xobj = new XMLHttpRequest();
            xobj.open("GET","menteelist.php",false);
            xobj.onreadystatechange = function(){
                if(xobj.readyState==4 && xobj.status==200){
                $(".content").css("display","block");
                 $(".loader").fadeOut(1000);
            }
        }
            xobj.send(null);
            $(".content").html(xobj.responseText);
        }

        function search(){
            $(".content").css("display","none");
             $(".loader").css("display","block");
            var vtu = $("#search-vtu").val();
            var sem = $("#search-sem").val();
            if(sem.length==1 && vtu.length>6 && vtu.length<9){
                var xobj = new XMLHttpRequest();
                 xobj.open("GET","search.php?vtu="+vtu+"&sem="+sem,false);
            xobj.onreadystatechange = function(){
                if(xobj.readyState==4 && xobj.status==200){
                $(".content").css("display","block");
                 $(".loader").fadeOut(1000);
            }
        }
                xobj.send(null);
                $(".content").html(xobj.responseText);
            }else{
                alert("Enter valid details");
            }
        }

        function results(){
            $(".content").css("display","none");
             $(".loader").css("display","block");
            var xobj = new XMLHttpRequest();
            xobj.open("GET","results.php",false);
            xobj.onreadystatechange = function(){
            if(xobj.readyState==4 && xobj.status==200){
                $(".content").css("display","block");
                 $(".loader").fadeOut(1000);
            }
        }
            xobj.send(null);
            $(".content").html(xobj.responseText);
        }

       function addMentee(){
        $(".content").css("display","none");
        $(".loader").css("display","block");
        var xobj = new XMLHttpRequest();
        xobj.open("GET","addmentee.php",false);
        xobj.onreadystatechange = function(){
            if(xobj.readyState==4 && xobj.status==200){
                $(".content").css("display","block");
                 $(".loader").fadeOut(1000);
            }
        }
        xobj.send(null);
        $(".content").html(xobj.responseText);
       }

      $(".list").click(function(){
        $(".list").removeClass("clicked");
        var id = $(this).attr("id");
        $("#"+id).addClass("clicked");
        $(".navbar-toggler").click();
      });

      $(".viewdet").click(function(){
          var vtu = $(this).attr("data-vtu");
          $(".content").load("studentdetails.php?vtu="+vtu);
      });

      //re-reg-form
      $(".re-reg-holder").click(function(){
          $(".content").load("re-registration/stu-re-reg.php?mid=<?php echo $mid?>");
      });
      $(window).ready(function(){
        $(".content").css("display","block");
        $(".loader").fadeOut(1000);
      });
     
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>

