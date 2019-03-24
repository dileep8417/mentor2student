<?php
    include "../../main/connection.php";
    if(isset($_GET['mid'])){
        $mid = $_GET['mid'];
        $res = mysqli_query($conn,"SELECT * FROM re_registration WHERE mentorid='$mid'");
        ?>
            <h2 class="text-primary">Student applied for Re-registration</h2>
        <?php
        if(mysqli_num_rows($res)>0){
            while($info = mysqli_fetch_assoc($res)){
                $vtu = $info['vtu'];
                $coursecode = $info['coursecode'];
                ?>
                
                <?php
            }
        }
    }
?>