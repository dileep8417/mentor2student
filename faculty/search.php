
<?php session_start();?>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-2.2.4.js"
         integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
         crossorigin="anonymous"></script>

<?php
include "main/../connection.php";
if(isset($_GET['vtu']) && isset($_GET['sem'])){
    $_SESSION['search']=$vtu=$_GET['vtu'];
    $sem=$_GET['sem'];
    $check_query="SELECT * FROM menteedetails WHERE vtu='$vtu'";
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
                $mid=$row['mentorid'];
            }
            //getting mentor no.
            $mcont = mysqli_query($conn,"SELECT mobile FROM mentorlogin WHERE id='$mid'");
            if(mysqli_num_rows($mcont)>0){
                $mno = mysqli_fetch_assoc($mcont);
            }

            //getting full profile info
            $getp = "SELECT * FROM stuprofile WHERE stuid='$vtu'";
            $getres = mysqli_query($conn,$getp);
            if(mysqli_num_rows($getres)>0){
                $profile = mysqli_fetch_assoc($getres);
                $pimg = '../student/'.$profile['profileimg'];
                if($profile['profileimg']=="" || $profile['profileimg']==null){
                    $pimg="../images/profile.png";
                }
                $profile = $profile['profileinfo'];
                $profile = json_decode($profile,true);
                $name = $profile[0]["name"];
                $semester = $profile[0]["sem"];
                $branch = $profile[0]["branch"];
            }
            ?>
            <head>
<style>
    .content{
        width:100%;
        position:relative;
        padding:20px;
        font-family:font-family: 'Noto Serif', serif;
    }
    .table-holder{
        overflow-X:auto;
    }
    .details tr td{
        padding:5px;
        padding-bottom:15px;
    }
    .details tr td:nth-child(even){
        color:red;
        padding-right:20px;
    }
    .table-holder table tr td,.table-holder table tr th{
        font-size:2.3vmin;
    }
    .details tr td:nth-child(odd){
        font-weight:bold;
    }
    .p-img{
        width:180px;
        height:190px;
        border-radius:5px;
        overflow:hidden;
    }
    .p-img img{
        width:100%;
        height:100%;
        margin-bottom:5px;
    }
 </style>
            </head>
    <?php
            $get_mentor="SELECT username FROM mentorlogin WHERE id='$mid'";
            $get_res=mysqli_query($conn,$get_mentor);
            if(mysqli_num_rows($get_res)>0){
                while($n=mysqli_fetch_assoc($get_res)){
                    $mentor = $n['username'];
                }
            }
        ?>
        <div class="p-img">
            <img src="<?php echo $pimg?>" alt="Student profile">
        </div>
        <table class="details" style="padding:15px">
               <tr>
                    <td>Student Name:</td>
                    <td><?php echo $name?></td>
                    <td>Branch:</td>
                    <td><?php echo strtoupper($branch)?></td>
                    <td>Current Semester:</td>
                    <td><?php echo $semester?></td>
               </tr>
               <tr>
                    <td>Mentor Name:</td>
                    <td><?php echo ucfirst($mentor)?></td>
                    <td>Mentor Contact No.</td>
                    <td><?php echo $mno['mobile']?></td>
               </tr>
        </table>
        <?php
        ?>
         
           
        <?php
    if($sem=="1"){
        if($sem1!=null){
            ?>
            <h3 class="text-danger">Semester-1</h3>
            <div class="table-holder" style="text-align:left !important">
            <?php
               $s1=json_decode($sem1);
                $len1 = count($s1);
            include "studb.php";
                    for($i=0;$i<$len1;$i++){              
                            ?>
                        <tr>
                            <td colspan='4' id='sem1-cat<?php echo $i?>'></td>
                            <td colspan='2' id='sem1-code<?php echo $i?>'></td>
                            <td  colspan='4' id='sem1-sub<?php echo $i?>'></td>
                            <td  colspan='2' id='sem1-grade<?php echo $i?>'></td>
                            <td  colspan='2' id='sem1-result<?php echo $i?>'></td>
                            <td  colspan='2' id='sem1-credits<?php echo $i?>'></td>
                            <td  colspan='2' id='sem1-yop<?php echo $i?>'></td>      
                        </tr>
                            <?php
                        }
                        ?>
                        </table>
                             
                     <script>
                           var sem1=JSON.parse('<?php echo $sem1?>');
                              var size=sem1.length;
                              for(i=0;i<size;i++){
                                   $("#sem1-cat"+i).html(sem1[i].category);
                                   $("#sem1-code"+i).html(sem1[i].scode);
                                   $("#sem1-sub"+i).html(sem1[i].subject);
                                   $("#sem1-grade"+i).html(sem1[i].grade);
                                   $("#sem1-result"+i).html("Pass");
                                   $("#sem1-credits"+i).html(sem1[i].scredit);
                                   $("#sem1-yop"+i).html(sem1[i].year);
                              }
                        </script>     
                <?php      
         }else{
            ?>
            <h3 class="text-danger">Semester-1 </h3>
            <p class="lead">No data available</p>
            <?php
         }    
    }
    ?>

    </div>
        
    <?php
    if($sem=="2"){
        if($sem2!=null){
            ?>
            <h3 class="text-danger">Semester-2</h3>
            <div class="table-holder">
            <?php
              $s2=json_decode($sem2);
             $len2 = count($s2);
                       include "studb.php";
                    for($i=0;$i<$len2;$i++){              
                            ?>
                        <tr>
                            <td colspan='4' id='sem2-cat<?php echo $i?>'></td>
                            <td colspan='2' id='sem2-code<?php echo $i?>'></td>
                            <td  colspan='4' id='sem2-sub<?php echo $i?>'></td>
                            <td  colspan='2' id='sem2-grade<?php echo $i?>'></td>
                            <td  colspan='2' id='sem2-result<?php echo $i?>'></td>
                            <td  colspan='2' id='sem2-credits<?php echo $i?>'></td>
                            <td  colspan='2' id='sem2-yop<?php echo $i?>'></td>      
                        </tr>
                            <?php
                        }
                        ?>
                        </table>
                             
                <script>
                           var sem2=JSON.parse('<?php echo $sem2?>');
                              var size=sem2.length;
                              for(i=0;i<size;i++){
                                   $("#sem2-cat"+i).html(sem2[i].category);
                                   $("#sem2-code"+i).html(sem2[i].scode);
                                   $("#sem2-sub"+i).html(sem2[i].subject);
                                   $("#sem2-grade"+i).html(sem2[i].grade);
                                   $("#sem2-result"+i).html("Pass");
                                   $("#sem2-credits"+i).html(sem2[i].scredit);
                                   $("#sem2-yop"+i).html(sem2[i].year);
                              }
                        </script>     
             <?php      
        }else{
            ?>
            <h3 class="text-danger">Semester-2 </h3>
            <p class="lead">No data available</p>
            <?php
         }
    }
    ?>
      </div>
        
    <?php
    if($sem=="3"){
        if($sem3!=null){
            ?>
           <h3 class="text-danger">Semester-3</h3>
           <div class="table-holder">
           <?php
           $s3=json_decode($sem3);
          $len3 = count($s3);
        
               include "studb.php";
                    for($i=0;$i<$len3;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem3-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem3-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem3-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem3-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem3-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem3-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem3-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
                            
                   <script>
                          var sem3=JSON.parse('<?php echo $sem3?>');
                             var size=sem3.length;
                             for(i=0;i<size;i++){
                                  $("#sem3-cat"+i).html(sem3[i].category);
                                  $("#sem3-code"+i).html(sem3[i].scode);
                                  $("#sem3-sub"+i).html(sem3[i].subject);
                                  $("#sem3-grade"+i).html(sem3[i].grade);
                                  $("#sem3-result"+i).html("Pass");
                                  $("#sem3-credits"+i).html(sem3[i].scredit);
                                  $("#sem3-yop"+i).html(sem3[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-3 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
    ?>
      </div>
       
    <?php
    if($sem=="4"){
        if($sem4!=null){
            ?>
           <h3 class="text-danger">Semester-4</h3>
           <div class="table-holder">
           <?php
           $s4=json_decode($sem4);
          $len4 = count($s4);
        
               include "studb.php";
               
                   for($i=0;$i<$len4;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem4-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem4-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem4-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem4-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem4-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem4-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem4-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
                            
        <script>
                          var sem4=JSON.parse('<?php echo $sem4?>');
                             var size=sem4.length;
                             for(i=0;i<size;i++){
                                  $("#sem4-cat"+i).html(sem4[i].category);
                                  $("#sem4-code"+i).html(sem4[i].scode);
                                  $("#sem4-sub"+i).html(sem4[i].subject);
                                  $("#sem4-grade"+i).html(sem4[i].grade);
                                  $("#sem4-result"+i).html("Pass");
                                  $("#sem4-credits"+i).html(sem4[i].scredit);
                                  $("#sem4-yop"+i).html(sem4[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-4 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
    ?>
      </div>
      
    <?php
    if($sem=="5"){
        if($sem5!=null){
            ?>
           <h3 class="text-danger">Semester-5</h3>
           <div class="table-holder">
           <?php
           $s5=json_decode($sem5);
          $len5 = count($s5);
        
               include "studb.php";
                   for($i=0;$i<$len5;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem5-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem5-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem5-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem5-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem5-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem5-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem5-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
                            
        <script>
                          var sem5=JSON.parse('<?php echo $sem5?>');
                             var size=sem5.length;
                             for(i=0;i<size;i++){
                                  $("#sem5-cat"+i).html(sem5[i].category);
                                  $("#sem5-code"+i).html(sem5[i].scode);
                                  $("#sem5-sub"+i).html(sem5[i].subject);
                                  $("#sem5-grade"+i).html(sem5[i].grade);
                                  $("#sem5-result"+i).html("Pass");
                                  $("#sem5-credits"+i).html(sem5[i].scredit);
                                  $("#sem5-yop"+i).html(sem5[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-5 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
    ?>
      </div>
        
    <?php
    if($sem=="6"){
        if($sem6!=null){
            ?>
           <h3 class="text-danger">Semester-6</h3>
           <div class="table-holder">
           <?php
           $s6=json_decode($sem6);
          $len6 = count($s6);
        
        include "studb.php";
                   for($i=0;$i<$len6;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem6-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem6-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem6-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem6-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem6-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem6-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem6-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
        <script>
                          var sem6=JSON.parse('<?php echo $sem6?>');
                             var size=sem6.length;
                             for(i=0;i<size;i++){
                                  $("#sem6-cat"+i).html(sem6[i].category);
                                  $("#sem6-code"+i).html(sem6[i].scode);
                                  $("#sem6-sub"+i).html(sem6[i].subject);
                                  $("#sem6-grade"+i).html(sem6[i].grade);
                                  $("#sem6-result"+i).html("Pass");
                                  $("#sem6-credits"+i).html(sem6[i].scredit);
                                  $("#sem6-yop"+i).html(sem6[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-6 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
    ?>
      </div>
        
    <?php
    if($sem=="7"){
        if($sem7!=null){
            ?>
           <h3 class="text-danger">Semester-7</h3>
           <div class="table-holder">
           <?php
           $s7=json_decode($sem7);
          $len7 = count($s7);
        
        include "studb.php";
                   for($i=0;$i<$len7;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem7-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem7-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem7-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem7-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem7-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem7-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem7-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
        <script>
                          var sem7=JSON.parse('<?php echo $sem7?>');
                             var size=sem7.length;
                             for(i=0;i<size;i++){
                                  $("#sem7-cat"+i).html(sem7[i].category);
                                  $("#sem7-code"+i).html(sem7[i].scode);
                                  $("#sem7-sub"+i).html(sem7[i].subject);
                                  $("#sem7-grade"+i).html(sem7[i].grade);
                                  $("#sem7-result"+i).html("Pass");
                                  $("#sem7-credits"+i).html(sem7[i].scredit);
                                  $("#sem7-yop"+i).html(sem7[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-7 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
    ?>
      </div>
       
    <?php
    if($sem=="8"){
        if($sem8!=null){
            ?>
           <h3 class="text-danger">Semester-8</h3>
           <div class="table-holder">
           <?php
           $s8=json_decode($sem8);
          $len8 = count($s8);
        
        include "studb.php";
                   for($i=0;$i<$len8;$i++){              
                           ?>
                       <tr>
                           <td  colspan='4' id='sem8-cat<?php echo $i?>'></td>
                           <td  colspan='2' id='sem8-code<?php echo $i?>'></td>
                           <td  colspan='4' id='sem8-sub<?php echo $i?>'></td>
                           <td  colspan='2' id='sem8-grade<?php echo $i?>'></td>
                           <td  colspan='2' id='sem8-result<?php echo $i?>'></td>
                           <td  colspan='2' id='sem8-credits<?php echo $i?>'></td>
                           <td  colspan='2' id='sem8-yop<?php echo $i?>'></td>      
                       </tr>
                           <?php
                       }
                       ?>
                       </table>
        <script>
                          var sem8=JSON.parse('<?php echo $sem8?>');
                             var size=sem8.length;
                             for(i=0;i<size;i++){
                                  $("#sem8-cat"+i).html(sem8[i].category);
                                  $("#sem8-code"+i).html(sem8[i].scode);
                                  $("#sem8-sub"+i).html(sem8[i].subject);
                                  $("#sem8-grade"+i).html(sem8[i].grade);
                                  $("#sem8-result"+i).html("Pass");
                                  $("#sem8-credits"+i).html(sem8[i].scredit);
                                  $("#sem8-yop"+i).html(sem8[i].year);
                             }
                       </script>     
        <?php      
       }else{
           ?>
           <h3 class="text-danger">Semester-8 </h3>
           <p class="lead">No data available</p>
           <?php
        }
    }
}else{
    ?>
    <h4 class="text-info"><?php echo $vtu?> not in the Database</h4>
    <?php
}
}
?>