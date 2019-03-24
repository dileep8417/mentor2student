<?php
    $conn = mysqli_connect("localhost","dileep","dileep4242","mentordb");
    if(isset($_GET['timetable']) && isset($_GET['vtu'])){
        $timetable=$_GET['timetable'];
        $vtu=$_GET['vtu'];
            $query="UPDATE menteedetails SET timetable='$timetable' WHERE vtu='$vtu'";
            $res=mysqli_query($conn,$query);
            if($res){
                echo "sent";
            }else{
                echo "wrong";
            }
        }
?>