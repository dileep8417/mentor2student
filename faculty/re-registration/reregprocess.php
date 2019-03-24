<?php
    include "../../main/connection.php";

    if(isset($_GET['n'])){
        $n = $_GET['n'];
        $amt = $n*5000;
        ?>
        
        <style>
            .re-reg-window{
                min-height:380px;
                overflow-Y:auto;
            }
            .re-reg-window select{
                margin-bottom:5px;
                display:block;
                margin:auto;
            }
        </style>
             <p class="lead text-info text-center"><b>Choose courses need to Re-register.</b></p><br>
             <p class="lead text-center" style="font-weight:bolder;margin-top:-20px">You need to pay<?php echo ' '.$n.' x 5000= '?><b><?php echo ' ₹'.$amt.' '?></b>and money will be added to your fee.</p>
        <?php
        for($i=1;$i<=$n;$i++){
            $res = mysqli_query($conn,"SELECT DISTINCT coursecode FROM courses");
            ?>
                <select id="sub<?php echo $i?>">
                <option value="">--Subject-<?php echo $i?>--</option>
            <?php
            while($row=mysqli_fetch_assoc($res)){
              ?>
                <option value="<?php echo $row['coursecode']?>"><?php echo $row['coursecode']?></option>
              <?php
            }
            ?>
            </select><br>
            <?php
        }
    }

    //sending re-registration
    if(isset($_POST['rereg'])){
        @session_start();
        $vtu = $_SESSION['vtu'];
        $sub =array();
        $sub = explode(",",$_POST['sub']);
        $res1 = mysqli_query($conn,"SELECT mentorid FROM stuprofile WHERE stuid='$vtu'");
        if($res1){
            $time = date("m-Y");
            $row1 = mysqli_fetch_assoc($res1);
            $mid = $row1['mentorid'];
            for($i=0;$i<count($sub);$i++){
                $course = $sub[$i];
                  $res = mysqli_query($conn,"INSERT INTO re_registration (vtu,coursecode,mentorid,requested_on) VALUES('$vtu','$course','$mid','$time')");
            }
            if($res){
                echo "sent";
              }
        }
    }
?>