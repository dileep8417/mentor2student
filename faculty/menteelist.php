<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
    @session_start();
    $uid=$_SESSION['id'];
    include "../main/connection.php";
    $query="SELECT * FROM menteedetails WHERE mentorid='$uid'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        ?>
        <style>
        @import url('https://fonts.googleapis.com/css?family=Overpass');

        .content{
          top:85px !important;
          display:block;
            margin:auto;
            width:95vw;
            min-width:350px;
            background:white;
            border-radius:10px;
            box-shadow:2px 3px 8px black;
            position:relative;
      }
      body{
          overflow:visible !important;
          font-family: 'Overpass', sans-serif !important;
      }
     
      .eachmentee{
          max-width:17vw;
          min-width:210px;
          height:280px;
          background:white;
          border-radius:10px;
          margin-right:25px;
          margin-left:25px;
            box-shadow:2px 3px 8px black;
            margin-bottom:22px !important;
            position:relative;
            padding:10px;
      }
      .mentee-profile{
          width:80px;
          border-radius:50%;
          display:block;
          margin:auto;
          margin-bottom:2px;
      }
      .eachmentee:hover{
          cursor:pointer;
          transform:scale(1.1);
      }
      .profile .table tr td{
          border:none !important;
      }
      .profile-img{
          width:85px;
          height:85px;
          border-radius:50%;
          overflow:hidden;
          position:relative;
          top:-25px;
          display:block;
          margin:auto;
      }
      .profile-img img{
          width:100%;
          height:100%;
      }
      @media(max-width:575px){
        .eachmentee{
            display:block;
            margin:auto;
        }
      }
        </style>
        <!----------------------------------------------->
        
    <div id="mlist">
    <div class="mentee-head text-center" style="padding:15px;color:#e55039"><h4>Your Mentees</h4></div>
        <div id="mbody" class="container" style="padding:10px;">
            <div class="row"> 
        <?php
            while($row=mysqli_fetch_assoc($res)){
                $name=$row['sname'];
                $vtu=$row['vtu'];

                $pquery = "SELECT * FROM stuprofile WHERE stuid='$vtu'";
                $pres = mysqli_query($conn,$pquery);
                if(mysqli_num_rows($pres)>0){
                    while($prow = mysqli_fetch_assoc($pres)){
                            $profile = $prow['profileimg'];
                            $info = $prow['profileinfo'];
                            $info =json_decode($info,true);
                    }
                }
                ?>
                <div class="eachmentee col-lg-3 col-md-3 col-xs-6 col-sm-4" data-vtu="<?php echo $vtu?>">
                      <div class="profile">
                            <div class="profile-img">
                            <?php
                                if($profile==""){
                                        ?>
                                            <img class="mentee-profile" src="../images/profile.png" alt="">
                                        <?php
                                }else{
                                    ?>
                                        <img src="<?php echo '../student/'.$profile?>" alt="">
                                    <?php
                                }
                            ?>
                            </div>
                            <?php
                                $name = explode(" ",$name);
                            ?>
                            <table class="table">
                                <tr>
                                    <td >Name :</td>
                                    <td style="color:#0abde3;font-weight:bold"><?php echo ucfirst($name[0])?></td>
                                </tr>
                                <tr>
                                    <td>VTU No :</td>
                                    <td style="color:#0abde3;font-weight:bold"><?php echo $info[0]["vtu"]?></td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan='2'><span style=""><i class="fas fa-mobile-alt"></i></span>&nbsp;&nbsp;<span style="color:#3F51B5"><?php echo $info[0]["smobile"]?></span></td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan='2'><button class="btn btn-warning viewdet"  data-vtu="<?php echo $vtu?>" style="padding:">View</button></td>
                                </tr>
                            </table>
                        </div>
                </div>
                    
                <?php
            }
            ?>
            </div> 
            <?php
    }else{
        ?>
        <h3 class="text-warning">Your mentee list is empty</h3>
        <button class="btn btn-info text-white" onClick="addMentee()">Add Mentee</button>
        <?php
    }
    ?>  
        </div>
    
    </div>
    <script>
          $(".viewdet,.eachmentee").click(function(){
            $(".content").css("display","none");
            $(".loader").css("display","block");
          var vtu = $(this).attr("data-vtu");
          $(".content").load("studentdetails.php?vtu="+vtu);
          $("#mentee-search").css("display","none");
      });

    </script>
            

