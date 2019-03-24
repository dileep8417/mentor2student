
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">  
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
 <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
    <title>Update Results</title>
    <style>
      .content{
        top:100px !important;
        width:80%;
        padding:15px;
        height:auto;
        background:white;
        border-radius:10px;
        box-shadow:2px 3px 5px black;
        display:block;margin:auto;
        overflow-X:auto;
      }
     
      body{
        overflow-x:hidden;
        background:#f5f6fa;
    }

      .grades-input{
        display:block;
        margin:auto;
      }
      .grades-input select,.modifyinputs select,.modifyinputs input{
        margin-right:8px;
        margin-bottom:8px;
      }
      .result-holder{
        margin-bottom:5px;
      }
      input,select{
        width:180px;
        border-radius:5px;
        border-color:#2475B0;
        outline:none;
        border-width:1px;
        padding-left:5px;
      }
      .grades-input button{
        left:45% !important;
      }
      .table tr td{
        border:none;
      }
      .table tr td:nth-child(odd){
        font-weight:bold;
      }
      .modifyinputs select,.modifyinputs input{
        display:block;
        margin:auto;
      }
      @media(max-width:850px){
        .grades-input{
          left:5%;
        }
      }
      @media(max-width:575px){
        .content{
          width:95%;
        }
      }
    </style>
</head>
<body>

      <?php

      #modifying the results
      if(isset($_GET['resmodify'])){
        $vtu = $_GET['vtu'];
        $sem = $_GET['sem'];
        include "../main/connection.php";
        $query = "SELECT * FROM menteedetails WHERE vtu='$vtu'";
        $res = mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
          while($row = mysqli_fetch_assoc($res)){
            $ssem = $row[$sem];
            $name = $row['sname'];
          }
            if($ssem==""|| $ssem==null){
                ?>
                  <script>
                    alert("Results of choosed semester is not added");
                    location.href="index.php";
                  </script>
                <?php
            }else{
              $semres = json_decode($ssem,true);
              $n = count($semres);
          ?>
            <h3 class="text-warning text-center">Modify Results</h3>
                    <div class="container">
                        <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
                            <table class="table">
                                <tr>
                                    <td>Student Name :</td>
                                    <td><?php echo $name?></td>
                                </tr>
                                <tr>
                                    <td>VTU No. :</td>
                                    <td><?php echo $vtu?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
            <style>
                #result-holder{
                  display:none;
                }
            </style>
              <div class="modifyinputs" style="position:relative;width:100%;text-align:center"></div>
              <button class="btn btn-primary" id="mres-btn" style="width:110px;display:block;margin:auto;margin-top:5px;margin-bottom:4px">Update</button>
                <script>
                  $(document).ready(function(){
                      $("#result-holder").empty();
                      $(".modifyinputs").load("resultsdb.php?resmodify=1&vtu=<?php echo $vtu?>&sem=<?php echo $sem?>&inputs=<?php echo $n?>");
                     
                  });
                </script>
          <?php
      }
    }
  }
      ?>

  <!-------------------------MARKS----------------------------------------->
  <div class="marks" style="position:relative;width:100%;text-align:center">
      <div id="result-holder">
    <?php
      if(isset($_GET['resmodify'])){
        ?>
        <h4 style="margin-bottom:18px;" class="text-primary">Modify results</h4>
      <?php
      }else{
          ?>
            <h4 style="margin-bottom:18px;" class="text-danger">Update results</h4>
          <?php
      }
    ?>
    <!--Messages display-->
    <div class="err text-danger"></div>
    <!------------------------------------------------------------------>

    <!--VTU NO FIELD-->
    <select id="vtu-results" style="margin-bottom:5px;">
      <option value="">Select Student</option>
        <?php
          @session_start();
          $id=$_SESSION['id'];
          include "../main/connection.php";
          $query="SELECT * FROM menteedetails WHERE mentorid='$id'";
          $res = mysqli_query($conn,$query);
          if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
              $vtu = $row['vtu'];
            ?>
              <option value="<?php echo $vtu?>"><?php echo $vtu?></option>
            <?php
          }
        }
        ?>
    </select>
    &nbsp;
    &nbsp;
    <!------------------------------------------------------------------>

    <!--SELECTING SEMESTER-->
    <select name="" id="sem-select" style="margin-bottom:5px;" required>
    <option value="">Select Semester</option> 
      <?php
        for($i=1;$i<9;$i++){
            ?>
            <option value='<?php echo $i?>'>Semester<?php echo $i?></option>
            <?php
        }
      ?>
    </select>&nbsp;
    <!------------------------------------------------------------------>
    <!--SELECTING NO. OF COURSES-->
    <select name="select" id="select" onchange="getInputs()" style="margin-bottom:5px;" required>
    <option value="">Select no. of courses</option> 
      <?php
        for($i=4;$i<15;$i++){
            ?>
            <option value='<?php echo $i?>'><?php echo $i?></option>
            <?php
        }
      ?>
    </select>
      </div>
    <!------------------------------------------------------------------>
    <!--DYNAMICALLY GENERATED FIELDS-->
    <img src="images/spinner.gif" style="display:none" width="130" alt="">
    <div class="grades-input" style="margin-bottom:5px">
    </div>
    <!------------------------------------------------------------------>
    
    <!--BUTTONS-->
    <button id="submit-another"  class="btn btn-info" style="display:none; position:relative;margin:auto;">Update another result</button>
    <button class="btn btn-success set-grades" style="display:none; position:relative;margin:auto;">Submit</button>
    <span><button class="clear btn btn-danger" style="display:none;margin:auto;" >Clear</button></span>
    <!------------------------------------------------------------------>
    </div>
        

    <!------------------------------------------------------------------>

    <!--SCRIPT-->
    <script>
  
        
      //VARIABLE DECLARATION
    var n;
    var marks=[];
    var marksobj={};
    //----------------------------
    //FUNCTIONS
    //GENERATE DYNAMIC INPUTS
    function getInputs(){
       var xmlobj = new XMLHttpRequest();
       n = $("#select").val();
       xmlobj.open("GET","resultsdb.php?inputs="+n,false);
       xmlobj.send(null);
       $(".grades-input").html(xmlobj.responseText); 
       $(".set-grades").css("display","inline-block");
        $(".set-grades").css("margin-top","4px");
        $(".clear").css("display","inline-block");
        $(".clear").css("margin-top","4px");    
    }
    //--------------------------------
    $("#submit-another").click(function(){
      $(this).css("display","none");
      $(".set-grades").css("display","inline-block");
      $("#vtu-results").val("");
      $("#sem-select").val("");  
      $(".results").val("");  
    });
   //AFTER CLICKING SUBMIT
    $(".set-grades").click(function(){
      //For checking
        for(i=1;i<=n;i++){
            var programcat=document.getElementById("pcat"+i);
            var vtu = $("#vtu-results").val();
            var grd = $("#grade"+i).val();
            var sem = $("#sem-select").val();
            if(programcat.value=="" || grd == ""){
             alert("Enter all the fields");
             return;
            }  
        }
        for(i=1;i<=n;i++){
            var programcat=document.getElementById("pcat"+i);
            var vtu = $("#vtu-results").val();
            var grd = $("#grade"+i).val();
            var sem = $("#sem-select").val();         
            var si = programcat.selectedIndex;
            var credits = programcat.options[si].getAttribute("data-credits").trim();
            var course = programcat.options[si].getAttribute("data-course").trim();
            var code = programcat.options[si].getAttribute("data-code").trim();
            var cat = programcat.options[si].getAttribute("data-category").trim();
            var examtype = $("#examtype"+i).val();
            var yop = $("#pass"+i).val();
            marksobj={
                subject:course,
                scode:code,
                scredit:credits,
                grade:grd,
                type:examtype,
                year:yop,
                category:cat
            };
           marks.push(marksobj);
        }
        jobj=JSON.stringify(marks);
        xobj5=new XMLHttpRequest();
        xobj5.open("GET","resultsdb.php?jobj="+jobj+"&sem="+sem+"&vtu="+vtu,false);
        xobj5.send(null);
        $(".err").html(xobj5.responseText);
        marks=[];
        $(".set-grades").css("display","none");
        $("#submit-another").css("display","inline-block");
    });

    //-------------------------------------------
    //CLEAR
   $(".clear").click(function(){
     $(".results").val("");
     $(".err").html("<h4 class='text-info'>Cleared!!</h4>");
   });
   //-----------------------------------------------

   //----------------------------------------
    //Modifying results
      <?php
        if(isset($_GET['resmodify'])){
            ?>
              var n="<?php echo $n?>";
              var sem="<?php echo $sem?>";
              var vtu="<?php echo $vtu?>";
            <?php
        }
      ?>
    $("#mres-btn").click(function(){
        //For checking
            for(i=1;i<=n;i++){
                var programcat=document.getElementById("pcat"+i);
                var grd = $("#grade"+i).val();
                if(programcat.value=="" || grd == ""){
                alert("Enter all the fields");
                return;
                }  
            }
            $(".content").css("display","none");
            $(".loader").css("display","block");
            $(".modifyinputs").css("display","none");
            for(i=1;i<=n;i++){
                var programcat=document.getElementById("pcat"+i);
                var grd = $("#grade"+i).val();         
                var si = programcat.selectedIndex;
                var credits = programcat.options[si].getAttribute("data-credits").trim();
                var course = programcat.options[si].getAttribute("data-course").trim();
                var code = programcat.options[si].getAttribute("data-code").trim();
                var cat = programcat.options[si].getAttribute("data-category").trim();
                var examtype = $("#examtype"+i).val();
                var yop = $("#pass"+i).val();
                marksobj={
                    subject:course,
                    scode:code,
                    scredit:credits,
                    grade:grd,
                    type:examtype,
                    year:yop,
                    category:cat
                };
              marks.push(marksobj);
            }
            jobj=JSON.stringify(marks);
            $.ajax({
              url:"resultsdb.php?modres="+jobj+"&sem="+sem+"&vtu="+vtu,
              type:"GET",
              success:function(resp){
                var r = resp.trim();
                if(r=="updated"){
                    alert("Results of "+vtu+" are modified.");
                    location.href="index.php";
                }else{
                  console.log(r);
                  $(".content").css("display","block");
                  $(".loader").css("display","none");
                  $(".modifyinputs").css("display","block");
                }
              }
            });
        });

   //----------------------------------------
    </script>
</body>
</html>