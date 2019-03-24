<style>
    .table tr td,.table tr th{
        font-size:1.4vmax;
    }
   
    @media(min-width:795px){
            table tr td,table tr th{
             font-size:15px !important;
       }
       }
</style>
<?php
    @session_start();
   if(isset($_SESSION['vtu'])){
        $vtu=$_SESSION['vtu'];
        ?>
            <style>
                 .content{
                    margin-top:100px;
                }
                table{
                position:relative;
                left:2vw;
                width:100vw !important;
            }
  
            </style>
             <p class="lead text-primary"style="padding-left:25px;font-size:22px;"><b>My Timetable</b></p>
        <?php
   }
   else{
       die("Something wrong");
   }
   include "../../main/connection.php";
   include "../../main/headfiles.php";
   ?>
   
  
    <table class="table table-striped" id="download">
        <tr class="bg-warning">
        <th>Category</th>
        <th>CourseCode</th>
        <th>Course Name</th>
        <th>Faculty Name</th>
        <th>Room No.</th>
        <th>Slot</th>
        <th>Credits</th>
        </tr>
    <?php
        $get_course_info = mysqli_query($conn,"SELECT * FROM course_enroll WHERE vtu='$vtu'");
        while($row = mysqli_fetch_assoc($get_course_info)){
        $coursecode = $row['coursecode'];
        $tts = $row['ttsno'];
        $slot=$row['slot'];
        $details = mysqli_query($conn,"SELECT * FROM courses WHERE coursecode='$coursecode' AND facultyname='$tts' AND slotno='$slot'");
        while($row2=mysqli_fetch_assoc($details)){
           $facultyname=$row2["facultyname"];
           $roomno=$row2["roomno"];
           $credits=$row2["credits"];
           $cat = $row2["coursecategory"];
           $course = $row2["coursename"];
           ?>
                <tr>
                    <td><?php echo "$cat"?></td>
                    <td><?php echo "$coursecode"?></td>
                    <td><?php echo "$course"?></td>
                    <td><?php echo "$facultyname"?></td>
                    <td><?php echo "$roomno"?></td>
                    <td><?php echo "$slot"?></td>
                    <td><?php echo "$credits"?></td>
                </tr>
           <?php

        }
    }
        ?>
</table>
<button class="btn btn-success" style="margin-left:35px;margin-top:10px;" onclick="exportToExcel('download')">Download</button>
<script>
    $(document).ready(function(){
        $(".content").css("display","block");
            $(".loader").fadeOut(300);
            $("#details-holder").css("display","block");
    });


    function exportToExcel(tableID){
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6' style='height: 75px; text-align: center; width: 250px'>";
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
</script>
