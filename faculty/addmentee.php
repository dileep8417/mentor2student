<?php
   
      if(isset($_GET['modify'])){
        $mvtu = $_GET['modify'];
        $mvtu = strtolower($mvtu);
        include "../main/connection.php";
        $query="SELECT * FROM stuprofile WHERE stuid='$mvtu'";
         $res = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($res)){
                  $profile = $row['profileinfo'];
                  $profile = json_decode($profile,true);
            }
      }
    
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mentee manager</title>
    <?php
        @session_start();
        $id = $_SESSION['id'];
   ?>

      <style>
        .addmentee-frame{
            width:85%;
            background:white;
            padding:15px;
            display:block;
            margin:auto;
            border-radius:10px;
            box-shadow:2px 3px 7px black;
        }  
        .addmentee-frame input{
            width:25vw;
            min-width:150px;
            border-radius:5px;
            border:.5px solid blue;
        }
        .addmentee-frame select{
           BORDER:.5PX solid blue;
           width:25vw;
           min-width:150px;
           border-radius:5px;
        }
        .addmentee-frame .table tr td{
            border:none !important;
        }
      @media(max-width:550px){
          .content{
              width:100%;
          }
        .addmentee-frame{
            width:100%;
        }
      }
      </style>
</head>
<body>
    
    <div class="addmentee-frame">

        <div class="errmsg text-danger text-center" style="font-size:24px;"></div>
                <?php
                    if(isset($_GET['modify'])){
                        ?>
                        <h3 class="text-primary text-center msg" style="padding:5px;font-size:28px">Update Mentee Details</h3>
                    <?php
                    }else{
                        ?>
                            <h3 class="text-danger text-center msg" style="padding:5px;font-size:40px">Add Mentee</h3>
                        <?php
                    }
                ?>
       
        <!---------------PERSONAL INFORMATION--------------->
        <div class="container">
            <div class="row">
       
        <!-----------------FRAME ONE PART------------------------------------->
            <div class="frame1 col-lg-6 col-md-6 col-sm-12 col-xs-12" >
            <h4 class="text-info">Student Details</h4>
                <table class="table">

                    <tr>
                        <td><span class="text-danger">*</span> Student name:</td>
                        <td><input type="text" value="<?php echo @$profile[0]['name']?>" id="sname"></td>
                    </tr>

                    <tr>
                        <td><span class="text-danger">*</span> VTU No.:</td>
                        <td><input type="text" id="svtu" value="<?php echo @$profile[0]['vtu']?>"></td>
                    </tr>

                    <tr>
                        <td><span class="text-danger">*</span> Gender:</td>
                        <td><input type="text" id="gender" value="<?php echo @$profile[0]['gender']?>"></td>
                    </tr>

                    <tr>
                        <td><span class="text-danger">*</span> Semester:</td>
                        <td>
                            <select name="" id="csem">
                                <option value="">Select semester</option>
                                <?php
                                    for($i=1;$i<=8;$i++){
                                        ?>
                                        <option value="<?php echo $i?>">Semester-<?php echo $i?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><span class="text-danger">*</span> Branch:</td>
                        <td><input type="text" value="<?php echo @$profile[0]['branch']?>" id="sbranch"></td>
                    </tr>

                    <tr>
                        <td>Blood group:</td>
                        <td><input type="text" value="<?php echo @$profile[0]['bgrp']?>" id="sbgrp"></td>
                    </tr>

                    <tr>
                        <td>Student DOB:</td>
                        <td><input type="date" value="<?php echo @$profile[0]['dob']?>" id="sdob"></td>
                    </tr>
                    
            <tr>
                <td><span class="text-danger"></span> Student Contact No.:</td>
                <td><input type="number" value="<?php echo @$profile[0]['smobile']?>" id="scno"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> Student MailId:</td>
                <td><input type="email" value="<?php echo @$profile[0]['mail']?>" id="smail"></td>
            </tr>
                </table>
            </div>
                                                                    <!----------ANOTHER FRAME------------------>
    
    <div class="frame2 col-lg-6 col-md-6 col-sm-12 col-xs-12" >
                  <h4 class="text-info">Accademic Details</h4>                  
        <table class="table">

            <tr>
                <td><span class="text-danger"></span> Registration no.:</td>
                <td><input type="text" value="<?php echo @$profile[0]['reg']?>" id="reg"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> 12th Result:</td>
                <td><input type="text" value="<?php echo @$profile[0]['inter']?>" id="interres"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> 12th College:</td>
                <td><input type="text" value="<?php echo @$profile[0]['college']?>" id="cllg"></td>
            </tr>
            <tr>
                <td><span class="text-danger"></span> 12th Year Of Pass:</td>
                <td><select name="" id="interyop">
                            <option value="">Select year of pass</option>
                            <?php
                                $cyear = date("Y");
                                for($i=$cyear-7;$i<=$cyear;$i++){
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                }
                               
                            ?>
                </select></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> 10th Result:</td>
                <td><input type="text" value="<?php echo @$profile[0]['ssc']?>" id="sscres"></td>
            </tr>
            
            <tr>
                <td><span class="text-danger"></span> School:</td>
                <td><input type="text" value="<?php echo @$profile[0]['school']?>" id="school"></td>
            </tr>
     </table>
      </div>

        <!-----------------FRAME ANOTHER PART------------------------------------->
 <div class="frame2 col-lg-6 col-md-6 col-sm-12 col-xs-12" >
 <h4 class="text-info">Personal Details</h4>
     <table class="table">

            <tr>
            <td><span class="text-danger"></span> Father name:</td>
            <td><input type="text" value="<?php echo @$profile[0]['father']?>" id="fname"></td>
            </tr>

            <tr>
            <td><span class="text-danger"></span> Mother name:</td>
            <td><input type="text" value="<?php echo @$profile[0]['mother']?>" id="mname"></td>
            </tr>

            <tr>
            <td><span class="text-danger"></span> Parent contact No.:</td>
            <td><input type="text" value="<?php echo @$profile[0]['parentno']?>" id="pcno"></td>
            </tr>

            <tr>
            <td><span class="text-danger"></span>Parent MailId</td>
            <td><input type="mail" value="<?php echo @$profile[0]['parentmail']?>" id="pmail"></td>
            </tr>

            
            <tr>
                <td><span class="text-danger"></span> State :</td>
                <td><input type="text" value="<?php echo @$profile[0]['state']?>" id="state"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> City/Town:</td>
                <td><input type="text" value="<?php echo @$profile[0]['city']?>" id="city"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span> Annual income:</td>
                <td><input type="text" value="<?php echo @$profile[0]['sal']?>" id="sal"></td>
            </tr>

            <tr>
                <td><span class="text-danger"></span>Father occupation:</td>
                <td><input type="text" value="<?php echo @$profile[0]['work']?>" id="occ"></td>
            </tr>
    </table>
    
  </div>
            </div>
            <?php
                if(isset($_GET['modify'])){
                    ?>
                    <button class="btn btn-primary" id="updatementee-btn" style="display:block;margin:auto;width:140px">Update Mentee</button>
                <?php
                }else{
                    ?>
                        <button class="btn btn-success" id="addmentee-btn" style="display:block;margin:auto;width:140px">ADD Mentee</button>
                    <?php
                }
            ?>
        </div>
    </div>

    <script>
    $("#csem").val("<?php echo @$profile[0]['sem']?>");
    $("#interyop").val("<?php echo @$profile[0]['interyop']?>");

        $(document).ready(function(){
            $(".content").css("display","block");
           $(".loader").css("display","none");
        });
        $("#addmentee-btn").click(function(){
            //student info
            var sname = $("#sname").val();
            var svtu = $("#svtu").val();
            var csem = $("#csem").val();
            var gen = $("#gender").val();
            var sbranch = $("#sbranch").val();
            var smail = $("#smail").val();
            var scno = $("#scno").val();
            var sdob = $("#sdob").val();
            var sbgrp = $("#sbgrp").val();
            //Accademic details
                var sreg = $("#reg").val();
                var cllg = $("#cllg").val();
                var sch = $("#school").val()
                var ires =$("#interres").val();
                var sres = $("#sscres").val();
                var iyop = $("#interyop").val();
            //parent info
            var fname = $("#fname").val();
            var mname = $("#mname").val();
            var pmail = $("#pmail").val();
            var pcno = $("#pcno").val();
            var ssal = $("#sal").val();
            var sstate = $("#state").val();
            var scity = $("#city").val(); 
            var occ = $("#occ").val();
           //Executing process
           if(sname.length<3 || svtu.length<7 || svtu.length>8 || csem.length=="" || sbranch.length=="" || gen.length<=3){
                alert("Must Fill Mandatory Properly Fields");
                $(".errmsg").text("Enter all required fields properly. Enter full VTU No.");
           }else{
            $(".content").css("display","none");
               $(".loader").css("display","block");
                var pobj = {
                    name:sname,
                    vtu:svtu,
                    sem:csem,
                    gender:gen,
                    branch:sbranch,
                    mail:smail,
                    smobile:scno,
                    dob:sdob,
                    bgrp:sbgrp,
                    reg:sreg,
                    college:cllg,
                    school:sch,
                    inter:ires,
                    ssc:sres,
                    interyop:iyop,
                    father:fname,
                    mother:mname,
                    parentmail:pmail,
                    parentno:pcno,
                    state:sstate,
                    city:scity,
                    work:occ,
                    sal:ssal
                };
                var profile=[];
                profile.push(pobj);
                profile = JSON.stringify(profile);
               var xhr= new XMLHttpRequest();
               xhr.open("GET","menteeDB.php?pdetails="+profile+"&vtu="+svtu+"&sname="+sname+"&mid=<?php echo $id?>",true);
                xhr.onreadystatechange = function(){
                    if(xhr.readyState==4 && xhr.status==200){
                            var resp = xhr.responseText;
                            if(resp=="exist"){
                                alert(sname+" is already added.");
                                $(".errmsg").text("VTU No."+svtu+ "already added by someone");
                            }else
                                alert(sname+" is added as your mentee.");
                                $("input,select").val("");
                            }
                        $(".content").css("display","block");
                         $(".loader").css("display","none");
                    }
                    xhr.send(null);
                }
           });


           //updating mentee
           <?php
            if(isset($_GET['modify'])){
                ?>
                $("#updatementee-btn").click(function(){
                     //student info
                var sname = $("#sname").val();
                var svtu = $("#svtu").val();
                var csem = $("#csem").val();
                var gen = $("#gender").val();
                var sbranch = $("#sbranch").val();
                var smail = $("#smail").val();
                var scno = $("#scno").val();
                var sdob = $("#sdob").val();
                var sbgrp = $("#sbgrp").val();
                //Accademic details
                    var sreg = $("#reg").val();
                    var cllg = $("#cllg").val();
                    var sch = $("#school").val()
                    var ires =$("#interres").val();
                    var sres = $("#sscres").val();
                    var iyop = $("#interyop").val();
                //parent info
                var fname = $("#fname").val();
                var mname = $("#mname").val();
                var pmail = $("#pmail").val();
                var pcno = $("#pcno").val();
                var ssal = $("#sal").val();
                var sstate = $("#state").val();
                var scity = $("#city").val(); 
                var occ = $("#occ").val();
            //Executing process
            if(sname.length<3 || svtu.length<7 || svtu.length>8 || csem.length=="" || sbranch.length==""){
                    alert("Must Fill Mandatory Properly Fields");
                    $(".errmsg").text("Enter all required fields properly. Enter full VTU No.");
            }else{
                $(".content").css("display","none");
                $(".loader").css("display","block");
                    var pobj = {
                        name:sname,
                        vtu:svtu,
                        sem:csem,
                        gender:gen,
                        branch:sbranch,
                        mail:smail,
                        smobile:scno,
                        dob:sdob,
                        bgrp:sbgrp,
                        reg:sreg,
                        college:cllg,
                        school:sch,
                        inter:ires,
                        ssc:sres,
                        interyop:iyop,
                        father:fname,
                        mother:mname,
                        parentmail:pmail,
                        parentno:pcno,
                        state:sstate,
                        city:scity,
                        work:occ,
                        sal:ssal
                    };
                    var profile=[];
                    profile.push(pobj);
                    profile = JSON.stringify(profile);
                    var mvtu ="<?php echo $mvtu?>";
                    $.ajax({
                        url:"menteeDB.php?moddetails="+profile+"&vtu="+mvtu+"&name="+sname,
                        type:"GET",
                        async:false,
                        success:function(resp){
                            var msg = resp;
                            if(msg=="success"){
                                alert(mvtu+" profile updated");
                                $("input select").val("");
                            }else{
                                alert("Something wrong...");
                            }
                            $(".content").css("display","block");
                            $(".loader").css("display","none");
                            location.href="index.php";
                        }
                    });
                    }
                });
                <?php
            }
           ?>
    </script>
</body>
</html>