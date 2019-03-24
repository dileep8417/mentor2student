<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">  
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous"></script>
            <style>
                  
                  body{
                        overflow-X:hidden;
                        background:#f5f6fa;
                  }
                  
            .content{
                 top:-23px;
            }
            .pimg{
                  width:180px;
                  height:190px;
                  display:block;
                  margin:auto;
                  border-radius:15%;
                  padding:15px;
                  position:relative;
                  top:10px;
                  margin-bottom:10px;
            }
            #details-holder{
                  width:95%;
                  height:auto;
                  border-radius:4px;
                  box-shadow:1px 1px 2px black;
                  display:block;
                  margin:auto;
                  transition:.5s all;
                  margin-bottom:10px;
            }
            .stu-info-holder{
                  margin-top:15px;
            }
            </style>

            
      <?php
            #DATABASE CONNECTION

      session_start();
      $uid=$_SESSION['id'];
      include "../main/connection.php";
      if(isset($_GET['vtu'])){
            $svtu=$_GET['vtu'];
            #----------------------------------------
            #-------------------------------------------------

            #Starting the program
      ?>
      <?php #-------------------------STUDENT DETAILS LIST-------------------------------------------------
            $query="SELECT * FROM stuprofile WHERE stuid='$svtu'";
            $res = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($res)){
                  $pimg = $row["profileimg"];
                  if($pimg==""){
                        $pimg="../images/profile.png";
                  }else{
                        $pimg = '../student/'.$pimg;
                  }
            }

      ?>
            

      <div class="stu-info" style="padding:0px;margin:0px;background:#3498db;color:white;width:100%;height:90px;margin-bottom:150px">
                  <!----profile image--->
                  <img src="<?php echo $pimg?>" alt="" class="pimg">

            <?php #--------------------------------------------------------------------------------------------?>
      </div>
            <div class="stu-info-holder" style="margin-left:2.5%;">
                  <button class="btn-info btn" id="profile-info">Profile</button>
                  <button class="btn btn-success" id="sem-details">Semester Results</button>
                  <button class="btn btn-warning" id="timetable-details">Timetable</button>
                  <button class="btn btn-primary" id="marks">Internals</button>
            </div>
            <div id="details-holder"></div>
            <script>

                  $("#profile-info").click(function(){
                        $("#details-holder").css("display","none");
                        $(".loader").css("display","block");
                        $("#details-holder").load("studentprofile.php?vtu=<?php echo $svtu?>");
                  });

                  $("#sem-details").click(function(){
                        $("#details-holder").css("display","none");
                        $(".loader").css("display","block");
                        $("#details-holder").load("semresults.php?vtu=<?php echo $svtu?>");
                  });
                  $("#timetable-details").click(function(){
                        $("#details-holder").css("display","none");
                        $(".loader").css("display","block");
                        $("#details-holder").load("stu-timetable.php?vtu=<?php echo $svtu?>");
                  });

                  $("#marks").click(function(){
                        $("#details-holder").css("display","none");
                        $(".loader").css("display","block");
                        $("#details-holder").load("stu-marks.php?vtu=<?php echo $svtu?>");
                  });
                  
                  $(document).ready(function(){
                        $(".mentee-search-holder").css("display","none");
                        $(".content").css("display","block");
                        $(".loader").css("display","none");
                        $("#details-holder").load("studentprofile.php?vtu=<?php echo $svtu?>");
                  });
            </script>
<?php
      }
?> 
            