
       <?php
        if(isset($_GET["student"])){
        ?>
            <style>
        .content{
            overflow-x:auto !important;
        }
       
            </style>
        <?php
    }
  
?>
  
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
                  .table-bottom{
                        background:#26de81 !important;
                        color:white;
                  }
                  #details-holder{
                      padding-bottom:25px;
                  }
                  .hide{
                        display:block;
                        transition:all 1s linear;
                        padding:25px;
                        color:black;
                        border-top-left-radius:15px;
                        border-top-right-radius:15px;
                        margin-top:50px;
                  }
                  
                #btns{
                  position:relative;
                  float:right;
                  right:0px;
                  width:80%;
                  height:auto;
                }
                  
     .edata{
        margin-top:38px;   
       }
       table{
          width:100% !important ;
        }
       table tr td,table tr th{
             font-size:1.4vmax;
       }
       @media(min-width:795px){
            table tr td,table tr th{
             font-size:15px;
       }
       }
       .hide ul li{
             font-size:2.8vmin;
       }
       .table-holder{
             width:100%;
             height:auto;
             overflow-X:auto;
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

            #Details of a particular student
            #If sem exams exist show else print data not available please update
            $check_query="SELECT * FROM menteedetails WHERE vtu='$svtu'";
            $check_res=mysqli_query($conn,$check_query);
            if(mysqli_num_rows($check_res)>0){
                  while($row=mysqli_fetch_assoc($check_res)){
                  $sname=$row['sname'];
                  $sem1=$row['sem1'];
                  $sem2=$row['sem2'];
                  $sem3=$row['sem3'];
                  $sem4=$row['sem4'];
                  $sem5=$row['sem5'];
                  $sem6=$row['sem6'];
                  $sem7=$row['sem7'];
                  $sem8=$row['sem8'];
                  }
            }
            #-------------------------------------------------

            #Starting the program
      ?>
      <style>
      @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Sans+Condensed');
     .hide ul li{
      display:inline-block;
      line-height:20px;
      position:relative;
      left:-40px;
      margin-left:20px;
      padding:10px;
      top:20px;
      font-weight:bold;
      font-family: 'IBM Plex Sans Condensed', sans-serif;
      }
      
      </style>
      <?php #-------------------------STUDENT DETAILS LIST-------------------------------------------------
            $query="SELECT * FROM stuprofile WHERE stuid='$svtu'";
            $res = mysqli_query($conn,$query);
            while($row=mysqli_fetch_assoc($res)){
                  $profile = $row['profileinfo'];
                  $profile = json_decode($profile,true);
                  $pimg = $row["profileimg"];
                  if($pimg==""){
                        $pimg="images/tmpprofile.png";
                  }
            }

      ?>
            

            <div style="position:relative;top:10px;padding:15px;float:right;margin-bottom:25px;font-weight:bold;font-size:18px" class="col-lg-3 col-md-3 col-xs-4 col-sm-4">
                        <span class="text-danger">R-</span>Registered <br>
                        <span class="text-danger">E-</span>Earned
            </div><br><br>
            <div class="hide">
            <?php #-------------------------OVERALL CREDITS AND SGPA-------------------------------------------------?>
                    <h4 class="text-primary">Total Registered Credits :</h4>
                  <ul>
                        <li id="totalFon">Foundation: </li>
                        <li id="totalPc">Program Core:</li>
                        <li id="totalPe">Program Elective: </li>
                        <li id="totalAe">Allied Elective: </li>
                        <li id="totalIe">Institute Elective: </li>
                        <li id="totalIl">Independent Learning: </li>
                        <li id="overall">Total Registered Credits: </li>
                        <li id="sgpa">SGPA: </li>
                  </ul>
            <?php #---------------------------------------------------------------------------------------?>
            </div>

            <?php #-------------------------TIMETABLE BUTTON-------------------------------------------------?>
      <br>
      <script>
      var totalFon=[];
      var totalPc=[];
      var totalPe=[];
      var totalAe=[];
      var totalIl=[];
      var totalIe=[];
      var overall=[];
      var sgpa=[];
      </script>
      <?php   
      $t=1;
      //SEM-1 details  
     
      if($sem1!=null){
            
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;font-size:5vmin">Semester-1</h3>
      <?php
            $s1=json_decode($sem1);
            $len1 = count($s1);
            ?>
            <b></b>
            <?php
            ?>
            <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px"  onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>
            <?php
      include "studb.php";
           
                  for($i=0;$i<$len1;$i++){              
                        ?>
                        
                  <tr>
                        <td colspan='4' id='sem1-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem1-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem1-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem1-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem1-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem1-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem1-yop<?php echo $i?>'></td>      
                  </tr>
                        <?php
                  }
                  ?>
                       
                  
                        <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom" >Program Core</th>
                  <th colspan='2' class="table-bottom" >Program Elective</th>
                  <th colspan='2' class="table-bottom" >Allied Elective</th>
                  <th colspan='2' class="table-bottom" >Institute Elective</th>
                  <th colspan='2' class="table-bottom" >Independent Learning</th>
                  <th colspan='2' class="table-bottom" >Total Registered Credits</th>
                  <th  colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom" >CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem1-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem1-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem1-cgpa"></th>                             
                  </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem1-fon"></th>
                        <th class="table-bottom" id="sem1-efon"></th>
                        <th class="table-bottom" id="sem1-pc"></th>
                        <th class="table-bottom" id="sem1-epc"></th>
                        <th class="table-bottom" id="sem1-pe"></th>
                        <th class="table-bottom" id="sem1-epe"></th>
                        <th class="table-bottom" id="sem1-ae"></th>
                        <th class="table-bottom" id="sem1-eae"></th>
                        <th class="table-bottom" id="sem1-ie"></th>
                        <th class="table-bottom" id="sem1-eie"></th>
                        <th class="table-bottom" id="sem1-il"></th>
                        <th class="table-bottom" id="sem1-eil"></th>
                  </tr>
                        </table>   
                  <script>
                        var sem1=JSON.parse('<?php echo $sem1?>');
                        var size=sem1.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem1[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem1[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem1[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem1[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem1[i].category=='Institute Elective' || sem1[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem1[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem1[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              
                              if(sem1[i].grade=="S"){
                                          var res = 10;
                                          $("#sem1-yop"+i).html(sem1[i].year);
                                    }else if(sem1[i].grade=="A"){
                                          var res = 9;
                                          $("#sem1-yop"+i).html(sem1[i].year);
                                    }else if(sem1[i].grade=="B"){
                                          var res = 8;
                                          $("#sem1-yop"+i).html(sem1[i].year);
                                    }else if(sem1[i].grade=="C"){
                                          var res = 7;
                                          $("#sem1-yop"+i).html(sem1[i].year);
                                    }else if(sem1[i].grade=="D"){
                                          var res = 6;
                                          $("#sem1-yop"+i).html(sem1[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem1-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem1[i].scredit);    
                                          $("#sem1-yop"+i).html("NILL");

                                          if(sem1[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem1[i].scredit);
                                          }
                                          if(sem1[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem1[i].scredit);
                                          }   
                                          if(sem1[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem1[i].scredit);
                                          }
                                          if(sem1[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem1[i].scredit);
                                          }
                                          if(sem1[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem1[i].scredit);
                                          }
                                          if(sem1[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem1[i].scredit);
                                          }

                                    }
                                    var calc = parseInt(sem1[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem1-cat"+i).html(sem1[i].category);
                              $("#sem1-code"+i).html(sem1[i].scode);
                              $("#sem1-sub"+i).html(sem1[i].subject);
                              $("#sem1-grade"+i).html(sem1[i].grade);
                              if(sem1[i].type=="RE"){
                                    $("#sem1-exam"+i).html("Regular");
                              }else{
                                    $("#sem1-exam"+i).html("Supply");
                              }
                              $("#sem1-credits"+i).html(sem1[i].scredit);
                        }
                        
                              //program core                 
                              var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem1-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem1-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem1-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem1-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem1-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem1-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem1-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem1-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem1-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem1-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem1-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem1-eil").html(earned);
                                                            
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem1-total").append(sum);
                              //Calculating CGPA 
                        //Converting Grades into numerical values S=10 A=9 B=8 C=7 D=6 NE=AB=RA=0
                        for(c=0;c<gradeToInt.length;c++){
                              cgpa=cgpa+gradeToInt[c];
                        }
                        sgpa.push(cgpa);
                        cgpa=cgpa/sum;
                        earned = sum-pending;
                        $("#sem1-cgpa").append(cgpa.toFixed(2));
                        $("#sem1-pending").append(earned);
                  </script>     
            <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-1 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //---------------------------------------------------
      ?>
            
      <?php
      //Sem-2 details
      if($sem2!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-2</h3>
      <?php
            $s2=json_decode($sem2);
      $len2 = count($s2);
      ?>
      <b></b>
            <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>
            <?php
      
                  include "studb.php";
                                   ?>
                  
                  <?php
                  for($i=0;$i<$len2;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem2-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem2-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem2-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem2-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem2-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem2-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem2-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
                       
             <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem2-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem2-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem2-cgpa"></th>                             
                        </tr>
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem2-fon"></th>
                        <th class="table-bottom" id="sem2-efon"></th>
                        <th class="table-bottom" id="sem2-pc"></th>
                        <th class="table-bottom" id="sem2-epc"></th>
                        <th class="table-bottom" id="sem2-pe"></th>
                        <th class="table-bottom" id="sem2-epe"></th>
                        <th class="table-bottom" id="sem2-ae"></th>
                        <th class="table-bottom" id="sem2-eae"></th>
                        <th class="table-bottom" id="sem2-ie"></th>
                        <th class="table-bottom" id="sem2-eie"></th>
                        <th class="table-bottom" id="sem2-il"></th>
                        <th class="table-bottom" id="sem2-eil"></th>
                  </tr>
                        </table>
            <script>
                        var sem2=JSON.parse('<?php echo $sem2?>');
                        var size=sem2.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem2[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].category=='Institute Elective' || sem2[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem2[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem2[i].grade=="S"){
                                          var res = 10;
                                          $("#sem2-yop"+i).html(sem2[i].year);
                                    }else if(sem2[i].grade=="A"){
                                          var res = 9;
                                          $("#sem2-yop"+i).html(sem2[i].year);
                                    }else if(sem2[i].grade=="B"){
                                          var res = 8;
                                          $("#sem2-yop"+i).html(sem2[i].year);
                                    }else if(sem2[i].grade=="C"){
                                          var res = 7;
                                          $("#sem2-yop"+i).html(sem2[i].year);
                                    }else if(sem2[i].grade=="D"){
                                          var res = 6;
                                          $("#sem2-yop"+i).html(sem2[i].year);
                                    }else{
                                          var res = 0;
                                    var par =  $("#sem2-grade"+i).parent().css("background","#ff7675");
                                    pending=pending+parseInt(sem2[i].scredit);
                                    $("#sem2-yop"+i).html("NILL");

                                    if(sem2[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem2[i].scredit);
                                          }
                                          if(sem2[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem2[i].scredit);
                                          }   
                                          if(sem2[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem2[i].scredit);
                                          }
                                          if(sem2[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem2[i].scredit);
                                          }
                                          if(sem2[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem2[i].scredit);
                                          }
                                          if(sem2[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem2[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem2[i].scredit)*res;
                                    gradeToInt.push(calc);
                              $("#sem2-cat"+i).html(sem2[i].category);
                              $("#sem2-code"+i).html(sem2[i].scode);
                              $("#sem2-sub"+i).html(sem2[i].subject);
                              $("#sem2-grade"+i).html(sem2[i].grade);
                              if(sem2[i].type=="RE"){
                                    $("#sem2-exam"+i).html("Regular");
                              }else{
                                    $("#sem2-exam"+i).html("Supply");
                              }
                              $("#sem2-credits"+i).html(sem2[i].scredit);
                        } 
                        
                              
                        //program core                 
                        var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem2-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem2-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem2-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem2-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem2-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem2-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem2-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem2-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem2-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem2-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem2-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem2-eil").html(earned);
                                
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem2-total").append(sum);   

                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem2-cgpa").append(cgpa.toFixed(2));
                              $("#sem2-pending").append(earned); 
                  </script> 
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-2 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //---------------------------------------------------------------
      //Sem-3 details
      if($sem3!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-3</h3>
      <?php
      $s3=json_decode($sem3);
      $len3 = count($s3);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
            include "studb.php";
                       ?>
            
            <?php
                  for($i=0;$i<$len3;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem3-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem3-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem3-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem3-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem3-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem3-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem3-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
                 <tr class="table text-center">
                   <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem3-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem3-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem3-cgpa"></th>                             
                        </tr>
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem3-fon"></th>
                        <th class="table-bottom" id="sem3-efon"></th>
                        <th class="table-bottom" id="sem3-pc"></th>
                        <th class="table-bottom" id="sem3-epc"></th>
                        <th class="table-bottom" id="sem3-pe"></th>
                        <th class="table-bottom" id="sem3-epe"></th>
                        <th class="table-bottom" id="sem3-ae"></th>
                        <th class="table-bottom" id="sem3-eae"></th>
                        <th class="table-bottom" id="sem3-ie"></th>
                        <th class="table-bottom" id="sem3-eie"></th>
                        <th class="table-bottom" id="sem3-il"></th>
                        <th class="table-bottom" id="sem3-eil"></th>
                  </tr>
                        </table> 
                  <script>
                        var sem3=JSON.parse('<?php echo $sem3?>');
                        var size=sem3.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem3[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].category=='Institute Elective' || sem3[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem3[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem3[i].grade=="S"){
                                          var res = 10;
                                          $("#sem3-yop"+i).html(sem3[i].year);
                                    }else if(sem3[i].grade=="A"){
                                          var res = 9;
                                          $("#sem3-yop"+i).html(sem3[i].year);
                                    }else if(sem3[i].grade=="B"){
                                          var res = 8;
                                          $("#sem3-yop"+i).html(sem3[i].year);
                                    }else if(sem3[i].grade=="C"){
                                          var res = 7;
                                          $("#sem3-yop"+i).html(sem3[i].year);
                                    }else if(sem3[i].grade=="D"){
                                          var res = 6;
                                          $("#sem3-yop"+i).html(sem3[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem3-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem3[i].scredit);
                                          $("#sem3-yop"+i).html("NILL");
                                          if(sem3[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem3[i].scredit);
                                          }
                                          if(sem3[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem3[i].scredit);
                                          }   
                                          if(sem3[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem3[i].scredit);
                                          }
                                          if(sem3[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem3[i].scredit);
                                          }
                                          if(sem3[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem3[i].scredit);
                                          }
                                          if(sem3[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem3[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem3[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem3-cat"+i).html(sem3[i].category);
                              $("#sem3-code"+i).html(sem3[i].scode);
                              $("#sem3-sub"+i).html(sem3[i].subject);
                              $("#sem3-grade"+i).html(sem3[i].grade);
                              if(sem3[i].type=="RE"){
                                    $("#sem3-exam"+i).html("Regular");
                              }else{
                                    $("#sem3-exam"+i).html("Supply");
                              }
                              $("#sem3-credits"+i).html(sem3[i].scredit); 
                        } 
       
                         //program core                 
                         var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem3-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem3-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem3-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem3-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem3-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem3-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem3-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem3-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem3-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem3-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem3-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem3-eil").html(earned);
                                
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem3-total").append(sum);
                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem3-cgpa").append(cgpa.toFixed(2));
                              $("#sem3-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-3 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //-------------------------------------------------------
      //Sem-4 details
      if($sem4!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-4</h3>
      <?php
      $s4=json_decode($sem4);
      $len4 = count($s4);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
            include "studb.php";
                       ?>
            
            <?php
            
                  for($i=0;$i<$len4;$i++){              
                        ?>
                 <tr>
                  <td colspan='4' id='sem4-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem4-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem4-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem4-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem4-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem4-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem4-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
            <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem4-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem4-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem4-cgpa"></th>                             
                        </tr>
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem4-fon"></th>
                        <th class="table-bottom" id="sem4-efon"></th>
                        <th class="table-bottom" id="sem4-pc"></th>
                        <th class="table-bottom" id="sem4-epc"></th>
                        <th class="table-bottom" id="sem4-pe"></th>
                        <th class="table-bottom" id="sem4-epe"></th>
                        <th class="table-bottom" id="sem4-ae"></th>
                        <th class="table-bottom" id="sem4-eae"></th>
                        <th class="table-bottom" id="sem4-ie"></th>
                        <th class="table-bottom" id="sem4-eie"></th>
                        <th class="table-bottom" id="sem4-il"></th>
                        <th class="table-bottom" id="sem4-eil"></th>
                  </tr>
                        </table>
                  <script>
                        var sem4=JSON.parse('<?php echo $sem4?>');
                        var size=sem4.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem4[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].category=='Institute Elective' || sem4[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem4[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem4[i].grade=="S"){
                                          var res = 10;
                                          $("#sem4-yop"+i).html(sem4[i].year);
                                    }else if(sem4[i].grade=="A"){
                                          var res = 9;
                                          $("#sem4-yop"+i).html(sem4[i].year);
                                    }else if(sem4[i].grade=="B"){
                                          var res = 8;
                                          $("#sem4-yop"+i).html(sem4[i].year);
                                    }else if(sem4[i].grade=="C"){
                                          var res = 7;
                                          $("#sem4-yop"+i).html(sem4[i].year);
                                    }else if(sem4[i].grade=="D"){
                                          var res = 6;
                                          $("#sem4-yop"+i).html(sem4[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem4-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem4[i].scredit);
                                          $("#sem4-yop"+i).html("NILL");

                                          if(sem4[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem4[i].scredit);
                                          }
                                          if(sem4[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem4[i].scredit);
                                          }   
                                          if(sem4[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem4[i].scredit);
                                          }
                                          if(sem4[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem4[i].scredit);
                                          }
                                          if(sem4[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem4[i].scredit);
                                          }
                                          if(sem4[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem4[i].scredit);
                                          }

                                    }
                                    var calc = parseInt(sem4[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem4-cat"+i).html(sem4[i].category);
                              $("#sem4-code"+i).html(sem4[i].scode);
                              $("#sem4-sub"+i).html(sem4[i].subject);
                              $("#sem4-grade"+i).html(sem4[i].grade);
                              if(sem4[i].type=="RE"){
                                    $("#sem4-exam"+i).html("Regular");
                              }else{
                                    $("#sem4-exam"+i).html("Supply");
                              }
                              $("#sem4-credits"+i).html(sem4[i].scredit);  
                        } 
                        
                        //program core                 
                        var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem4-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem4-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem4-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem4-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem4-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem4-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem4-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem4-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem4-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem4-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem4-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem4-eil").html(earned);
                                
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem4-total").append(sum);
                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem4-cgpa").append(cgpa.toFixed(2));
                              $("#sem4-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-4 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //--------------------------------------------------------------
      //Sem-5 details
      if($sem5!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-5</h3>
      <?php
      $s5=json_decode($sem5);
      $len5 = count($s5);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
            include "studb.php";
                       ?>
            
            <?php
                  for($i=0;$i<$len5;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem5-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem5-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem5-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem5-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem5-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem5-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem5-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
               <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem5-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem5-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem5-cgpa"></th>                             
                        </tr>
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem5-fon"></th>
                        <th class="table-bottom" id="sem5-efon"></th>
                        <th class="table-bottom" id="sem5-pc"></th>
                        <th class="table-bottom" id="sem5-epc"></th>
                        <th class="table-bottom" id="sem5-pe"></th>
                        <th class="table-bottom" id="sem5-epe"></th>
                        <th class="table-bottom" id="sem5-ae"></th>
                        <th class="table-bottom" id="sem5-eae"></th>
                        <th class="table-bottom" id="sem5-ie"></th>
                        <th class="table-bottom" id="sem5-eie"></th>
                        <th class="table-bottom" id="sem5-il"></th>
                        <th class="table-bottom" id="sem5-eil"></th>
                  </tr>
                        </table>
                  <script>
                        var sem5=JSON.parse('<?php echo $sem5?>');
                        var size=sem5.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem5[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].category=='Institute Elective' || sem5[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem5[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem5[i].grade=="S"){
                                          var res = 10;
                                          $("#sem5-yop"+i).html(sem5[i].year);
                                    }else if(sem5[i].grade=="A"){
                                          var res = 9;
                                          $("#sem5-yop"+i).html(sem5[i].year);
                                    }else if(sem5[i].grade=="B"){
                                          var res = 8;
                                          $("#sem5-yop"+i).html(sem5[i].year);
                                    }else if(sem5[i].grade=="C"){
                                          var res = 7;
                                          $("#sem5-yop"+i).html(sem5[i].year);
                                    }else if(sem5[i].grade=="D"){
                                          var res = 6;
                                          $("#sem5-yop"+i).html(sem5[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem5-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem5[i].scredit);
                                          $("#sem5-yop"+i).html("NILL");

                                          if(sem5[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem5[i].scredit);
                                          }
                                          if(sem5[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem5[i].scredit);
                                          }   
                                          if(sem5[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem5[i].scredit);
                                          }
                                          if(sem5[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem5[i].scredit);
                                          }
                                          if(sem5[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem5[i].scredit);
                                          }
                                          if(sem5[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem5[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem5[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem5-cat"+i).html(sem5[i].category);
                              $("#sem5-code"+i).html(sem5[i].scode);
                              $("#sem5-sub"+i).html(sem5[i].subject);
                              $("#sem5-grade"+i).html(sem5[i].grade);
                              if(sem5[i].type=="RE"){
                                    $("#sem5-exam"+i).html("Regular");
                              }else{
                                    $("#sem5-exam"+i).html("Supply");
                              }
                              $("#sem5-credits"+i).html(sem5[i].scredit);
                        } 

                        
                       //program core                 
                       var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem5-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem5-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem5-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem5-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem5-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem5-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem5-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem5-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem5-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem5-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem5-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem5-eil").html(earned);
                                
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem5-total").append(sum);
                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem5-cgpa").append(cgpa.toFixed(2));
                              $("#sem5-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-5 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //----------------------------------------------------
      //Sem-6 details
      if($sem6!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-6</h3>
      <?php
      $s6=json_decode($sem6);
      $len6 = count($s6);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
      include "studb.php";
           ?>
      
      <?php
                  for($i=0;$i<$len6;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem6-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem6-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem6-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem6-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem6-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem6-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem6-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
             <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem6-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem6-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem6-cgpa"></th>                             
                        </tr>
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem6-fon"></th>
                        <th class="table-bottom" id="sem6-efon"></th>
                        <th class="table-bottom" id="sem6-pc"></th>
                        <th class="table-bottom" id="sem6-epc"></th>
                        <th class="table-bottom" id="sem6-pe"></th>
                        <th class="table-bottom" id="sem6-epe"></th>
                        <th class="table-bottom" id="sem6-ae"></th>
                        <th class="table-bottom" id="sem6-eae"></th>
                        <th class="table-bottom" id="sem6-ie"></th>
                        <th class="table-bottom" id="sem6-eie"></th>
                        <th class="table-bottom" id="sem6-il"></th>
                        <th class="table-bottom" id="sem6-eil"></th>
                  </tr>
                  </table>
                  <script>
                        var sem6=JSON.parse('<?php echo $sem6?>');
                        var size=sem6.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem6[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].category=='Institute Elective' || sem6[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem6[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem6[i].grade=="S"){
                                          var res = 10;
                                          $("#sem6-yop"+i).html(sem6[i].year);
                                    }else if(sem6[i].grade=="A"){
                                          var res = 9;
                                          $("#sem6-yop"+i).html(sem6[i].year);
                                    }else if(sem6[i].grade=="B"){
                                          var res = 8;
                                          $("#sem6-yop"+i).html(sem6[i].year);
                                    }else if(sem6[i].grade=="C"){
                                          var res = 7;
                                          $("#sem6-yop"+i).html(sem6[i].year);
                                    }else if(sem6[i].grade=="D"){
                                          var res = 6;
                                          $("#sem6-yop"+i).html(sem6[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem6-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem6[i].scredit);
                                          $("#sem6-yop"+i).html("NILL");

                                          if(sem6[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem6[i].scredit);
                                          }
                                          if(sem6[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem6[i].scredit);
                                          }   
                                          if(sem6[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem6[i].scredit);
                                          }
                                          if(sem6[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem6[i].scredit);
                                          }
                                          if(sem6[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem6[i].scredit);
                                          }
                                          if(sem6[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem6[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem6[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem6-cat"+i).html(sem6[i].category);
                              $("#sem6-code"+i).html(sem6[i].scode);
                              $("#sem6-sub"+i).html(sem6[i].subject);
                              $("#sem6-grade"+i).html(sem6[i].grade);
                              if(sem6[i].type=="RE"){
                                    $("#sem6-exam"+i).html("Regular");
                              }else{
                                    $("#sem6-exam"+i).html("Supply");
                              }
                              $("#sem6-credits"+i).html(sem6[i].scredit);     
                        } 
                        
                                                

                         //program core                 
                         var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem6-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem6-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem6-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem6-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem6-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem6-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem6-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem6-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem6-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem6-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem6-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem6-eil").html(earned);
                                

                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem6-cgpa").append(cgpa.toFixed(2));
                              $("#sem6-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-6 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //-------------------------------------------------------
      //Sem-7 details
      if($sem7!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-7</h3>
      <?php
      $s7=json_decode($sem7);
      $len7 = count($s7);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
      include "studb.php";
           ?>
      
      <?php
                  for($i=0;$i<$len7;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem7-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem7-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem7-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem7-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem7-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem7-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem7-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
               <tr class="table text-center">
                 <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem7-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem7-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem7-cgpa"></th>                             
                        </tr>
                        </tr>
                   <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem7-fon"></th>
                        <th class="table-bottom" id="sem7-efon"></th>
                        <th class="table-bottom" id="sem7-pc"></th>
                        <th class="table-bottom" id="sem7-epc"></th>
                        <th class="table-bottom" id="sem7-pe"></th>
                        <th class="table-bottom" id="sem7-epe"></th>
                        <th class="table-bottom" id="sem7-ae"></th>
                        <th class="table-bottom" id="sem7-eae"></th>
                        <th class="table-bottom" id="sem7-ie"></th>
                        <th class="table-bottom" id="sem7-eie"></th>
                        <th class="table-bottom" id="sem7-il"></th>
                        <th class="table-bottom" id="sem7-eil"></th>
                  </tr>
                  </table>
                  <script>
                        var sem7=JSON.parse('<?php echo $sem7?>');
                        var size=sem7.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem7[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].category=='Institute Elective' || sem7[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem7[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem7[i].grade=="S"){
                                          var res = 10;
                                          $("#sem7-yop"+i).html(sem7[i].year);
                                    }else if(sem7[i].grade=="A"){
                                          var res = 9;
                                          $("#sem7-yop"+i).html(sem7[i].year);
                                    }else if(sem7[i].grade=="B"){
                                          var res = 8;
                                          $("#sem7-yop"+i).html(sem7[i].year);
                                    }else if(sem7[i].grade=="C"){
                                          var res = 7;
                                          $("#sem7-yop"+i).html(sem7[i].year);
                                    }else if(sem7[i].grade=="D"){
                                          var res = 6;
                                          $("#sem7-yop"+i).html(sem7[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem7-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem7[i].scredit);
                                          $("#sem7-yop"+i).html("NILL");

                                          if(sem7[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem7[i].scredit);
                                          }
                                          if(sem7[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem7[i].scredit);
                                          }   
                                          if(sem7[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem7[i].scredit);
                                          }
                                          if(sem7[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem7[i].scredit);
                                          }
                                          if(sem7[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem7[i].scredit);
                                          }
                                          if(sem7[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem7[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem7[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem7-cat"+i).html(sem7[i].category);
                              $("#sem7-code"+i).html(sem7[i].scode);
                              $("#sem7-sub"+i).html(sem7[i].subject);
                              $("#sem7-grade"+i).html(sem7[i].grade);
                              if(sem7[i].type=="RE"){
                                    $("#sem7-exam"+i).html("Regular");
                              }else{
                                    $("#sem7-exam"+i).html("Supply");
                              }
                              $("#sem7-credits"+i).html(sem7[i].scredit);    
                        } 
                        
                                                

                         //program core                 
                         var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem7-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem7-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem7-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem7-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem7-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem7-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem7-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem7-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem7-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem7-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem7-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem7-eil").html(earned);
                                

                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem7-total").append(sum);

                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem7-cgpa").append(cgpa.toFixed(2));
                              $("#sem7-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-7 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      //--------------------------------------------------------
      //Sem-8 details
      if($sem8!=null){
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-8</h3>
      <?php
      $s8=json_decode($sem8);
      ?>
      <?php
      $len8 = count($s8);
      ?>
      <b></b>
      <button class="btn btn-success" style="float:right;position:relative;right:20px;margin-bottom:5px" onClick="exportToExcel('Semester-<?php echo $t;?>')">Export to Excel</button>

      <?php
      include "studb.php";
           ?>
      
      <?php
                  for($i=0;$i<$len8;$i++){              
                        ?>
                  <tr>
                  <td colspan='4' id='sem8-cat<?php echo $i?>'></td>
                        <td colspan='2' id='sem8-code<?php echo $i?>'></td>
                        <td  colspan='4' id='sem8-sub<?php echo $i?>'></td>
                        <td colspan='2' id='sem8-grade<?php echo $i?>'></td>
                        <td colspan='2' id='sem8-exam<?php echo $i?>'></td>
                        <td colspan='2' id='sem8-credits<?php echo $i?>'></td>
                        <td colspan='2' id='sem8-yop<?php echo $i?>'></td>     
                  </tr>
                        <?php
                  }
                  ?>
                  
               <tr class="table text-center">
                  <th colspan='2' class="table-bottom">Foundation</th>
                  <th colspan='2' class="table-bottom">Program Core</th>
                  <th colspan='2' class="table-bottom">Program Elective</th>
                  <th colspan='2' class="table-bottom">Allied Elective</th>
                  <th colspan='2' class="table-bottom">Institute Elective</th>
                  <th colspan='2' class="table-bottom">Independent Learning</th>
                  <th colspan='2' class="table-bottom">Total Registered Credits</th>
                  <th colspan='2' class="table-bottom">Total Earned Credits</th>
                  <th colspan='2' class="table-bottom">CGPA</th>
                        </tr>
                        <tr class="text-center text-primary" style="background:white !important;font-weight:bold;">
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <td>R</td>
                              <td>E</td>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px" class="table-bottom" id="sem8-total"></th>
                              <th colspan='2' rowspan='2' style="background:white !important; color:red;padding:30px;font-size:18px"  class="table-bottom"> <span id="sem8-pending">0</span></th>
                              <th style="background:white !important; color:red;padding:30px;font-size:18px;" rowspan='2' class="table-bottom" id="sem8-cgpa"></th>                             
                        </tr>
                        <tr class='table text-center credits'>
                        <th class="table-bottom" id="sem8-fon"></th>
                        <th class="table-bottom" id="sem8-efon"></th>
                        <th class="table-bottom" id="sem8-pc"></th>
                        <th class="table-bottom" id="sem8-epc"></th>
                        <th class="table-bottom" id="sem8-pe"></th>
                        <th class="table-bottom" id="sem8-epe"></th>
                        <th class="table-bottom" id="sem8-ae"></th>
                        <th class="table-bottom" id="sem8-eae"></th>
                        <th class="table-bottom" id="sem8-ie"></th>
                        <th class="table-bottom" id="sem8-eie"></th>
                        <th class="table-bottom" id="sem8-il"></th>
                        <th class="table-bottom" id="sem8-eil"></th>
                  </tr>
                  </table>
                  <script>
                        var sem8=JSON.parse('<?php echo $sem8?>');
                        var size=sem8.length;
                        var pc=[];
                        var pe=[];
                        var fon=[];
                        var ae=[];
                        var ie=[];
                        var il=[];
                        var pending=0;
                        var penPc=0;
                        var penFon=0;
                        var penPe=0;
                        var penIe=0;
                        var penAe=0;
                        var penIl=0;
                        
                        var total=[];
                        var earned=0;
                        var gradeToInt=[];
                        var cgpa=0;
                        for(i=0;i<size;i++){
                              if(sem8[i].category=='Program Core'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    pc.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPc.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].category=='Foundation'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    fon.push(pcCredit);
                                    total.push(pcCredit);
                                    totalFon.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].category=='Program Elective'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    pe.push(pcCredit);
                                    total.push(pcCredit);
                                    totalPe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].category=='Allied Elective'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalAe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].category=='Institute Elective' || sem8[i].category=='University Elective'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    ae.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIe.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].category=='Independent Learning'){
                                    var pcCredit=parseInt(sem8[i].scredit);
                                    il.push(pcCredit);
                                    total.push(pcCredit);
                                    totalIl.push(pcCredit);
                                    overall.push(pcCredit);
                              }
                              if(sem8[i].grade=="S"){
                                          var res = 10;
                                          $("#sem8-yop"+i).html(sem8[i].year);
                                    }else if(sem8[i].grade=="A"){
                                          var res = 9;
                                          $("#sem8-yop"+i).html(sem8[i].year);
                                    }else if(sem8[i].grade=="B"){
                                          var res = 8;
                                          $("#sem8-yop"+i).html(sem8[i].year);
                                    }else if(sem8[i].grade=="C"){
                                          var res = 7;
                                          $("#sem8-yop"+i).html(sem8[i].year);
                                    }else if(sem8[i].grade=="D"){
                                          var res = 6;
                                          $("#sem8-yop"+i).html(sem8[i].year);
                                    }else{
                                          var res = 0;
                                          var par =  $("#sem8-grade"+i).parent().css("background","#ff7675");
                                          pending=pending+parseInt(sem8[i].scredit);
                                          $("#sem8-yop"+i).html("NILL");

                                          if(sem8[i].category=="Program Core"){
                                                penPc=penPc+parseInt(sem8[i].scredit);
                                          }
                                          if(sem8[i].category=="Program Elective"){
                                                penPe=penPe+parseInt(sem8[i].scredit);
                                          }   
                                          if(sem8[i].category=="Institute Elective"){
                                                penIe=penIe+parseInt(sem8[i].scredit);
                                          }
                                          if(sem8[i].category=="Independent Learning"){
                                                penIl=penIl+parseInt(sem8[i].scredit);
                                          }
                                          if(sem8[i].category=="Allied Elective"){
                                                penAe=penAe+parseInt(sem8[i].scredit);
                                          }
                                          if(sem8[i].category=="Foundation"){
                                                penFon=penFon+parseInt(sem8[i].scredit);
                                          }
                                    }
                                    var calc = parseInt(sem8[i].scredit)*res;
                                    gradeToInt.push(calc);

                              $("#sem8-cat"+i).html(sem8[i].category);
                              $("#sem8-code"+i).html(sem8[i].scode);
                              $("#sem8-sub"+i).html(sem8[i].subject);
                              $("#sem8-grade"+i).html(sem8[i].grade);
                              if(sem8[i].type=="RE"){
                                    $("#sem8-exam"+i).html("Regular");
                              }else{
                                    $("#sem8-exam"+i).html("Supply");
                              }
                              $("#sem8-credits"+i).html(sem8[i].scredit);
                        }                         

                         //program core                 
                         var sum=0;
                              for(c=0;c<pc.length;c++){
                              sum=sum+pc[c];
                              }
                              $("#sem8-pc").append(sum).addClass("text-danger");

                              var earned = sum-penPc;
                              $("#sem8-epc").html(earned);
                              
                              //program elective
                              var sum=0;
                              for(c=0;c<pe.length;c++){
                              sum=sum+pe[c];
                              }
                              $("#sem8-pe").append(sum).addClass("text-danger");

                              var earned = sum-penPe;
                              $("#sem8-epe").html(earned);
                        
                              //allied elective
                              var sum=0;
                              for(c=0;c<ae.length;c++){
                              sum=sum+ae[c];
                              }
                              $("#sem8-ae").append(sum).addClass("text-danger");

                              var earned = sum-penAe;
                              $("#sem8-eae").html(earned);
                        
                              //foundation
                              var sum=0;
                              for(c=0;c<fon.length;c++){
                              sum=sum+fon[c];
                              }
                              $("#sem8-fon").append(sum).addClass("text-danger");

                              var earned = sum-penFon;
                              $("#sem8-efon").html(earned);
                        
                              //institute elective
                              var sum=0;
                              for(c=0;c<ie.length;c++){
                              sum=sum+ie[c];
                              }
                              $("#sem8-ie").append(sum).addClass("text-danger");

                              var earned = sum-penIe;
                              $("#sem8-eie").html(earned);

                              //Independent Learning
                              var sum=0;
                              for(c=0;c<il.length;c++){
                              sum=sum+il[c];
                              }
                              $("#sem8-il").append(sum).addClass("text-danger");

                              var earned = sum-penIl;
                              $("#sem8-eil").html(earned);
                                
                              var sum=0;
                              for(c=0;c<total.length;c++){
                              sum=sum+total[c];
                              }
                              $("#sem8-total").append(sum);
                              for(c=0;c<gradeToInt.length;c++){
                                    cgpa=cgpa+gradeToInt[c];
                              }
                              sgpa.push(cgpa);
                              cgpa=cgpa/sum;
                              earned = sum-pending;
                              $("#sem8-cgpa").append(cgpa.toFixed(2));
                              $("#sem8-pending").append(earned); 
                  </script>     
      <?php      
      }else{
      ?>
      <h3 class="text-danger" style="position:relative;left:10px;top:45px;">Semester-8 </h3>
      <p class="lead edata" style="positon:relative;top:35px;margin-left:25px">No data available</p>
      <?php
      }
      ?>
      </div>
      <?php
      #Calculating Total credits
      ?>
      <script>
      var sgpaTotal=0;
      var sum=0;
      for(c=0;c<totalPc.length;c++){
      sum=sum+totalPc[c];
      }
      $("#totalPc").append(" "+sum);
      var sum=0;
      for(c=0;c<totalPe.length;c++){
      sum=sum+totalPe[c];
      }
      $("#totalPe").append(" "+sum);
      var sum=0;
      for(c=0;c<totalFon.length;c++){
      sum=sum+totalFon[c];
      }
      $("#totalFon").append(" "+sum);
      var sum=0;
      for(c=0;c<totalAe.length;c++){
      sum=sum+totalAe[c];
      }
      $("#totalAe").append(" "+sum);
      var sum=0;
      for(c=0;c<totalIe.length;c++){
      sum=sum+totalIe[c];
      }
      $("#totalIe").append(" "+sum);

      var sum=0;
      for(c=0;c<totalIl.length;c++){
      sum=sum+totalIl[c];
      }
      $("#totalIl").append(" "+sum);

      var sum=0;
      for(c=0;c<overall.length;c++){
      sum=sum+overall[c];
      }
      $("#overall").append(" "+sum);

      for(c=0;c<sgpa.length;c++){
            sgpaTotal=sgpaTotal+sgpa[c];
      }
      sgpa=sgpaTotal/sum;
      $("#sgpa").append(" "+sgpa.toFixed(2));
      </script> 
      <script>
      function exportToExcel(tableID){
      var tab_text="<h1>"+tableID+"</h1> <h3><?php echo "Student Name: ".$sname?> <br><?php echo "VTU No: ".$svtu?></H3><table border='2px'><tr bgcolor='#67e6dc' style='height: 75px; text-align: center; width: 250px'>";
      var textRange; var j=0;
      tab = document.getElementById(tableID); // id of table
      for(j = 0 ; j < tab.rows.length ; j++)
      {
            tab_text=tab_text;
            tab_text=tab_text+tab.rows[j].innerHTML.toUpperCase()+"</tr>";
            //tab_text=tab_text+"</tr>";
      }
      tab_text= tab_text+"</table>";
      tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
      tab_text= tab_text.replace(/<img[^>]*>/gi,""); //remove if u want images in your table
      tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); //remove input params
      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE ");
      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
      {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write( 'sep=,\r\n' + tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa=txtArea1.document.execCommand("SaveAs",true,"sudhir123.txt");
      }
      else {
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
      }
      
      return (sa);
      }

            $(document).ready(function(){
                 $(".mentee-search-holder").css("display","none");
                 $(".faculty-search-holder").css("display","none");
                $("#details-holder").css("display","block");
                $(".content").css("display","block");
                $(".loader").fadeOut(300);
            });
      </script>
      <?php
      }
      ?>
