
<?php
   session_start();
   include "../main/connection.php";
   $mid=$_SESSION['id'];
   #Asking Number of subjects
     if(isset($_GET['inputs'])){
        $n=$_GET['inputs'];
?>
    <!--creating table -->
    <!--Table head-->
    <style>
        table th{
            color:#D63031;
        }

    </style>
         <table cellspace='2'>
         <th>S.No</th>
         <th>Course code</th>
         <th>Grades</th>
        <th>Exam type</th>
        <th>Year of pass</th>
        <!---------------------------->
        <tr>
        <td colspan="5"><div class="" style="width:100%;border:.5px solid orange;margin-bottom:7px;margin-top:7px;"></div></td>
      </tr>
        <!--GETTING COURSE CODES-->

         <?php
         for($k=1;$k<=$n;$k++){
            $query="SELECT DISTINCT coursecode FROM courses";
            $res=mysqli_query($conn,$query);
             ?>
       <tr>
       <th class="text-info"><?php echo "Subject-".$k?>:-</th>
       <td><select class="results" id='pcat<?php echo $k?>' required>
        <option value="">Select CourseCode</option>
         <?php
         while($row=mysqli_fetch_assoc($res)){
                $coursecode=$row['coursecode'];
                $query2="SELECT * FROM courses WHERE coursecode='$coursecode'";
                $res2=mysqli_query($conn,$query2);
                while($row2=mysqli_fetch_assoc($res2)){
                    $id=$row2['id'];
                    $credits=$row2['credits'];
                    $category=$row2['coursecategory'];
                    $course=$row2['coursename'];                    
                }
                    ?>
                    <option data-credits='<?php echo $credits?>' data-category='<?php echo $category?>' data-course='<?php echo $course?>' data-code='<?php echo  $coursecode?>' value='<?php echo  $coursecode?>'><?php echo $coursecode?></option>
                    <?php     
        }?></select></td>
        <!--------------------------------------------------->

        <!--CREATING GRADES-->
        <td><select class="results" name="" id='grade<?php echo $k?>' required>
            <option value="">Select Grade</option>
            <option value="S">S</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="FAIL">FAIL</option>
            <option value="AB">AB</option>
            <option value="NE">NE</option>
        </select></td>
        <!--------------------------------------------------->

        <!--EXAM CATEGORY-->
        <td>
          <select class="" value="RE" name="" id='examtype<?php echo $k?>' required>
          <option value="RE">Regular</option>
          <option value="RA">Supply</option>
          </select>
        </td>
        <!---------------------------------------------------->

        <!---YOP-->
        <td>
        <input class="" id='pass<?php echo $k?>' type="text" placeholder="Year of pass" required>
        </td>
        <!----------------------------------------------------------->
        </tr>
        <tr>
        <td colspan="5"><div class="" style="width:100%;border:.5px solid orange;margin-bottom:7px;margin-top:7px;"></div></td>
      </tr>
        <?php
     }?>
     
     </table>
    
     <!----------------------------------------------------------->
     <?php
    }

     if(isset($_GET["jobj"]) && isset($_GET["sem"]) && isset($_GET["vtu"])){
        $marks=$_GET["jobj"];
        $vtu=$_GET["vtu"];
        $sem=$_GET["sem"];
        $check_query="SELECT * FROM menteedetails WHERE vtu='$vtu' AND mentorid='$mid'";
        $check_res=mysqli_query($conn, $check_query);
        if(mysqli_num_rows($check_res)>0){
            while($row=mysqli_fetch_assoc($check_res)){
                $sem1=$row['sem1'];
                $sem2=$row['sem2'];
                $sem3=$row['sem3'];
                $sem4=$row['sem4'];
                $sem5=$row['sem5'];
                $sem6=$row['sem6'];
                $sem7=$row['sem7'];
                $sem8=$row['sem8'];
            }
        }else{
            ?>
            <h4 class="text-warning"><?php echo $vtu?> is not your mentee</h4>
            <?php
            die();
        }

        #checking from validte we need to add the course if it is not present in $already_enrolled
        $check_already_enrolled = mysqli_query($conn,"SELECT * FROM validate WHERE vtu='$vtu'");
        #if vtu no. exist
        if(mysqli_num_rows($check_already_enrolled)){
            if($row['already_enrolled']==" " || $row['already_enrolled']==""){
              $already_enrolled = array(); //if $already_enrolled is empty
            }else{
              $already_enrolled =explode(",", $row['already_enrolled']); //else
            }
        }else{
          //if vtu no. not exist.
            $insert_vtu = mysqli_query($conn,"INSERT INTO validate (vtu) VALUES ('$vtu')");
            if($insert_vtu){
              $already_enrolled = array();
            }
        }

        #comparing these subjects with $already_enrolled if subject not exist in $already_enrolled push else leave.
        #if $already_enrolled is not empty.
        $prev_subjects = json_decode($marks,true);
       
          if(count($already_enrolled)>0){
            for($i=0;$i<count($prev_subjects);$i++){
            for($j=0;$j<count($already_enrolled);$j++){
              if($prev_subjects[$i]['scode']!=$already_enrolled[$j]){
                array_push($already_enrolled,$prev_subjects[$i]['scode']);
              }
          }
        }
      }else{
        for($i=0;$i<count($prev_subjects);$i++){
          array_push($already_enrolled,$prev_subjects[$i]['scode']);
        }
      }
      #updating $already_enrolled.
      $already_enrolled = implode(",",$already_enrolled);
      $update_validate_already_enrolled = mysqli_query($conn,"UPDATE validate SET already_enrolled='$already_enrolled' WHERE vtu='$vtu'");
      
      if($update_validate_already_enrolled){
        if($sem=="1" & $sem1==null){
            $query="UPDATE menteedetails SET sem1 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
         
        }else if($sem=="2" & $sem2==null){
            $query="UPDATE menteedetails SET sem2 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
            
        }else if($sem=="3" & $sem3==null){
            $query="UPDATE menteedetails SET sem3 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
            
        }
        else if($sem=="4" & $sem4==null){
            $query="UPDATE menteedetails SET sem4 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="5" & $sem5==null){
            $query="UPDATE menteedetails SET sem5 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="6" & $sem6==null){
            $query="UPDATE menteedetails SET sem6 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="7" & $sem7==null){
            $query="UPDATE menteedetails SET sem7 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="8" & $sem8==null){
            $query="UPDATE menteedetails SET sem8 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }else{
            ?>
            <h4 class="text-danger"><?php echo 'Semester-'.$sem." results of ".$vtu." is already added"?></h4>
            <?php
            die();
        }
        ?>
        <h4 class="text-success">Successfully added</h4>
        <?php 
    }
  }
    
      #updating results
      if(isset($_GET['modres']) && isset($_GET['vtu']) && isset($_GET['sem'])){
        $marks = $_GET['modres'];
        $vtu = $_GET['vtu'];
        $sem = $_GET['sem'];
        if($sem=="sem1"){
          $query="UPDATE menteedetails SET sem1 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
            $res=mysqli_query($conn,$query);
       
        }else if($sem=="sem2"){
            $query="UPDATE menteedetails SET sem2 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
            
        }else if($sem=="sem3"){
            $query="UPDATE menteedetails SET sem3 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="sem4"){
            $query="UPDATE menteedetails SET sem4 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="sem5"){
            $query="UPDATE menteedetails SET sem5 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="sem6"){
            $query="UPDATE menteedetails SET sem6 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="sem7"){
            $query="UPDATE menteedetails SET sem7 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }
        else if($sem=="sem8"){
            $query="UPDATE menteedetails SET sem8 ='$marks' WHERE vtu='$vtu' AND mentorid='$mid'";
              $res=mysqli_query($conn,$query);
        }else{
              echo "error";
              die();
        }
        echo "updated";
      }


      #modifying the results
      if(isset($_GET['resmodify'])){
        $vtu = $_GET['vtu'];
        $sem = $_GET['sem'];
        include "../main/connection.php";
        $rmequery = "SELECT * FROM menteedetails WHERE vtu='$vtu'";
        $modres = mysqli_query($conn,$rmequery);
        if(mysqli_num_rows($modres)>0){
          while($row = mysqli_fetch_assoc($modres)){
            $ssem = $row[$sem];
            $name = $row['sname'];
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
                <script>
                    $(document).ready(function(){
                        $(".content").css("display","block");
                         $(".loader").css("display","none");
                    });
                    $(".modifyres").load("resultsDB.php?inputs=<?php echo $n?>");
                    <?php
                      for($i=1;$i<=$n;$i++){
                          ?>
                            $("#pcat<?php echo $i?>").val("<?php echo $semres[$i-1]['scode']?>");
                            $("#grade<?php echo $i?>").val("<?php echo $semres[$i-1]['grade']?>");
                            $("#examtype<?php echo $i?>").val("<?php echo $semres[$i-1]['type']?>");
                            $("#pass<?php echo $i?>").val("<?php echo $semres[$i-1]['year']?>");
                          <?php
                      }
                    ?>
                </script>
              <?php
            }
          }
        }
      }
      ?>

