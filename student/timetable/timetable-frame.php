
<p class="lead text-primary" style="font-weight:bolder;">Timetable</p>
 <div style="width:100vw;overflow:auto" class="main">
<table border='1' id="test" class="table" style="" cellpadding='0' cellspacing='0'>
    <?php
    #creating Time-table layout
    $days=array('Days','Mon','Tue','Wed','Thur','Fri');
    $time=array('7.45-8.35','8.45-9.35','9.45-10.35','10.45-11.35','11.45-12.35','12.45-1.35','1.45-2.35','2.45-3.35','3.45-4.35','4.45-5.35','5.45-6.35','6.45-7.35');
        for($i=0;$i<6;$i++){
            ?>
            <tr class="tab-row">
            <th class="bg-info text-center text-white"><?php echo $days[$i]?></th>
            <?php  
            for($j=1;$j<=11;$j++){
                if($i==0){
                    ?>
                    <th class="bg-info text-center text-white"><?php echo $time[$j-1]?></th>
                <?php
                }else{
                    ?>
                    <td id="<?php echo "box-".$i.$j?>"></td>
                <?php
                } 
            }?>
            </tr>
            <?php
        }
    ?>
</table>
</div>