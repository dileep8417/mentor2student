<?php
$conn=mysqli_connect("localhost","dileep",'dileep4242','mentordb') or die("Unable to connect");
#Fetching courses from category
if(isset($_GET['category'])){
    $category=$_GET['category'];
    $query="SELECT DISTINCT coursename FROM courses WHERE coursecategory='$category'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        ?>
        <select id="selectCourse">
            <option value="">Select Course</option>
        <?php
        while($row=mysqli_fetch_assoc($res)){
            $courses=$row['coursename'];
            if($courses==""){
                continue;
            }
            ?>
            <option data-category="<?php echo $category?>" value="<?php echo $courses?>"><?php echo $courses?></option>
            <?php
        }
        ?></select><?php
    }else{
        ?>
        <option value=""><?php echo "No course"?></option>
        <?php
    }
}
#Fetching Facuilty from Course
if(isset($_GET['courses'])){
    $courses=$_GET['courses'];
    $query="SELECT DISTINCT facultyname FROM courses WHERE coursename='$courses'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        ?>
        <select id="selectTeacher">
            <option value="">Select Facuilty</option>
        <?php
        while($row=mysqli_fetch_assoc($res)){
            $facuilty=$row['facultyname'];
            if($facuilty==""){
                continue;
            }
            ?>
            <option value="<?php echo $facuilty?>"><?php echo $facuilty?></option>
            <?php
        }
        ?></select><?php
    }else{
        ?>
        <option value=""><?php echo "No facuilty available"?></option>
        <?php
    }
}
#Fetching slots based on facuilty name and course name
if(isset($_GET['course']) && isset($_GET['facuilty'])){
    $course=$_GET['course'];
    $facuilty=$_GET['facuilty'];
    $query="SELECT slotno,coursecode,roomno,credits FROM courses WHERE coursename='$course' and facultyname='$facuilty'";
    $res=mysqli_query($conn,$query);
    if(mysqli_num_rows($res)>0){
        ?>
        <select id="slot">
            <option value="">Select Slot</option>
        <?php
        while($row=mysqli_fetch_assoc($res)){
            $slot=$row['slotno'];
            $coursecode=$row['coursecode'];
            $roomno=$row['roomno'];
            if($slot==""){
                continue;
            }
            ?>
            <option data-coursecode="<?php echo $coursecode?>" data-credits="<?php echo $row['credits']?>" data-roomno="<?php echo $roomno?>" value="<?php echo $slot?>"><?php echo $slot?></option>
            <?php
        }
        ?></select><?php
    }else{
        ?>
        <option value=""><?php echo "No Slots available"?></option>
        <?php
    }
}


?>