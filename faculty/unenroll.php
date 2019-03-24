<?php

    @session_start();
    $vtu = $_SESSION["vtu"];
    $query = "SELECT * FROM course_enroll WHERE vtu='$vtu'";
  $res = mysqli_query($conn,$query);
  if(mysqli_num_rows($res)>0){
      ?>
          <table class="table" style="max-width:550px;">
            <tr>
                <th>Subject Name</th>
                <th>Faculty Name</th>
                <th>Slot</th>
                <th>Option</th>
            </tr>
      <?php
    while($row = mysqli_fetch_assoc($res)){
        $slot = $row["slot"];
        $tts = $row["ttsno"];
        $coursecode = $row["coursecode"];
        $delid = $row["id"];
        $res2 = mysqli_query($conn,"SELECT * FROM courses WHERE coursecode='$coursecode' AND facultyname='$tts'");
        $details = mysqli_fetch_assoc($res2);
        ?>
      
            <tr>
                <td><?php echo $details['coursename']?></td>
                <td><?php echo $details['facultyname']?></td>
                <?php
                    if($details['slotno']!="" || $details['slotno']!=" "){
                        ?>
                            <td><?php echo $details['slotno']?></td>
                        <?php
                    }else{
                        ?>
                            <td><?php echo "-"?></td>
                        <?php
                    }
                ?>
                <td><button class="btn btn-danger unenroll-btn" data-credits="<?php echo $details['credits']?>" data-slot="<?php echo $slot?>" data-ccode="<?php echo $coursecode?>" data-sub="<?php echo $details['coursename']?>" style="padding:5px;font-size:13px" id="<?php echo $delid?>" value="<?php echo $delid?>">unenroll</button></td>
            </tr>
        <?php
    }
  }
?>
</table>
<script>
    $(".unenroll-btn").click(function(){
        var subject = $(this).attr("data-sub");
        var ccode = $(this).attr("data-ccode");
        var delcredit = $(this).attr("data-credits");
        var delslot = $(this).attr("data-slot");
        if(confirm("Do you want to unenroll "+subject)){
            $.ajax({
                url:"timetable/validate.php",
                        type:"POST",
                        data:{
                            unenroll:true,
                            slot:delslot,
                            coursecode:ccode,
                            credits:delcredit
                        },
                        success:function(resp){
                            resp=resp.trim();
                            if(resp=="unenrolled"){
                                alert(subject+" unenrolled");
                                $(".content").load("timetable/index.php");
                            }else{
                                alert("Something wrong");
                            }
                        }
            });
    }
    });
</script>
