<?php
    if(isset($_GET['vtu'])){
        @session_start();
        $vtu = $_GET['vtu'];
        include "../main/connection.php";
        $query="SELECT * FROM stuprofile WHERE stuid='$vtu'";
         $res = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($res)){
                  $profile = $row['profileinfo'];
                  $profile = json_decode($profile,true);
                        $id = $_SESSION['id'];
                        $profileimage = $row['profileimg'];
                       if(!isset($_SESSION['student'])){
                        $profileimage = '../student/'.$row['profileimg'];
                       }
                        if($row['profileimg']=="" || $row['profileimg']==null){
                            $profileimage = "../images/profile.png";
                        }
            }
    }
    if(isset($_GET["student"])){
        ?>
            <style>
        .content{
            width:90vw;
            display:block;
            margin:auto;
            padding:20px;
            margin-top:10px;
            border-radius:10px;
            box-shadow:2px 3px 6px black;
        }        
            </style>
        <?php
    }
  
?>
        
    <style>
        .table tr td{
            border:none !important;
        }
        #details-holder{
            padding:15px;
        }
        .table tr td:nth-child(odd){
            font-weight:bold;
        }
        .profile-img{
            width:180px;
            height:190px;
            border-radius:5px;
        }
        .profile-img img{
            width:100%;
            height:100%;
        }
        
    </style>
<div class="container">
    <div class="row">
    <div class="profile-frame col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <?php
                        if(isset($_SESSION['student'])){
                            ?>
                                <div class="profile-img">
                                    <img src="<?php echo $profileimage?>" id="img" alt="Profile image">
                                </div>
                                <span><button class="btn btn-info" style="padding:3px;margin-top:2px;margin-bottom:4px;font-size:15px" onClick="document.getElementById('file').click()" id="upload-profile-btn">Upload</button></span>
                            <input type="file" id="file" style="display:none" onchange="preview.call(this)">
                            <?php
                        }
                    
                    ?>

                <h4 class="text-primary">Profile Details</h4>
                <table class="table">
                    <tr>
                        <td>Name :</td>
                        <td><?php echo ucfirst($profile[0]["name"])?></td>
                    </tr>

                    <tr>
                        <td>VTUNo. :</td>
                        <td><?php echo $profile[0]["vtu"]?></td>
                    </tr>

                    <tr>
                        <td>Branch:</td>
                        <td><?php echo $profile[0]["branch"]?></td>
                    </tr>

                    <tr>
                        <td>Gender:</td>
                        <td><?php echo $profile[0]["gender"]?></td>
                    </tr>

                    <tr>
                        <td>Current Semester :</td>
                        <td><?php echo $profile[0]["sem"]?></td>
                    </tr>

                    <tr>
                        <td>Mobile No. :</td>
                        <td><?php echo $profile[0]["smobile"]?></td>
                    </tr>

                    <tr>
                        <td>Email id :</td>
                        <td><?php echo $profile[0]["mail"]?></td>
                    </tr>

                    <tr>
                        <td>Date of Birth:</td>
                        <td id="dob"></td>
                    </tr>

                    <tr>
                        <td>Blood Group :</td>
                        <td><?php echo $profile[0]["bgrp"]?></td>
                    </tr>
                </table>
        </div>
        <div class="profile-frame col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h4 class="text-warning">Personal Details</h4>
      <table class="table">
                    <tr>
                        <td>Father Name :</td>
                        <td><?php echo ucfirst($profile[0]["father"])?></td>
                    </tr>
         
                    <tr>
                        <td>Mother Name :</td>
                        <td><?php echo ucfirst($profile[0]["mother"])?></td>
                    </tr>

                     <tr>
                        <td>Parent Contact no. :</td>
                        <td><?php echo $profile[0]["parentno"]?></td>
                    </tr>

                    <tr>
                        <td>Parent Email Id :</td>
                        <td><?php echo $profile[0]["parentmail"]?></td>
                    </tr>

                    <tr>
                        <td>Annual Income :</td>
                        <td><?php echo $profile[0]["sal"]?></td>
                    </tr>

                    <tr>
                        <td>Parent Occupation:</td>
                        <td><?php echo $profile[0]["work"]?></td>
                    </tr>

                    <tr>
                        <td>Address :</td>
                        <td><?php echo strtoupper($profile[0]["city"])."<br>".strtoupper($profile[0]["state"])?></td>
                    </tr>
                </table>
        </div>

        <div class="profile-frame col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h4 class="text-success">Accademic Details</h4>
            <table class="table">
                <tr>
                    <td>Registration No. :</td>
                    <td><?php echo strtoupper($profile[0]['reg'])?></td>
                </tr>

                <tr>
                    <td>12th Result :</td>
                    <td><?php echo $profile[0]['inter']?></td>
                </tr>

                <tr>
                    <td>12th College :</td>
                    <td><?php echo $profile[0]['college']?></td>
                </tr>

                <tr>
                    <td>12th Year of pass: </td>
                    <td><?php echo $profile[0]['interyop']?></td>
                </tr>

                <tr>
                    <td>10th Result :</td>
                    <td><?php echo $profile[0]['ssc']?></td>
                </tr>

                <tr>
                    <td>School:</td>
                    <td><?php echo $profile[0]['school']?></td>
                </tr>

            </table>
      </div>
    </div>
</div>
<script>
     $(document).ready(function(){
                $("#details-holder").css("display","block");
                $(".mentee-search-holder").css("display","none");
                $(".loader").fadeOut(300);
            });
</script>

           <?php
             //inserting dob
           ?>
         <script>
            $(document).ready(function(){
                $(".content").css("display","block");
                $(".loader").fadeOut(300);
            });
                var sdob = "<?php echo $profile[0]['dob']?>";
                    if(sdob!=""){
                        sdob=sdob.split("-");
                        var tmp=sdob[0];
                        sdob[0]=sdob[2];
                        sdob[2]=tmp;
                        sdob=sdob.join("-");
                    }
                    $("#dob").text(sdob);    

            //profile upload

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
        </script>


