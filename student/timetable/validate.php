<?php

    if(isset($_POST['enroll'])){
        @session_start();
        if(isset($_SESSION['vtu'])){
            $id = $_SESSION['vtu'];
        }
        include "../../main/connection.php";
        $getdetails = mysqli_query($conn,"SELECT * FROM validate WHERE vtu='$id'");
        if(mysqli_num_rows($getdetails)>0){
           $row = mysqli_fetch_assoc($getdetails);

           $will_clash = explode(",",$row['will_clash']);
           if($row['will_clash']=="" || $row['will_clash']==null){
                $will_clash = array();
           }

           $already_enrolled = explode(",",$row['already_enrolled']);
           if($row['already_enrolled']=="" || $row['already_enrolled']==null){
                $already_enrolled = array();
           }

           $enrolled_slots = explode(",",$row['enrolled_slots']);
           if($row['enrolled_slots']=="" || $row['enrolled_slots']==null){
                $enrolled_slots = array();
           }

           $enrolled_credits = (int)($row['check_credits']);
        }else{
            $insert = mysqli_query($conn,"INSERT INTO validate (vtu) VALUES ('$id')");
                $will_clash = array();
                $already_enrolled = array();
                $enrolled_slots=array();
                $enrolled_credits = 0;       
        }
        #data send by the student
        $tts = $_POST['tts'];
        $vtu = $_POST['vtu'];

        $coursecode = $_POST['coursecode']; //compare it with $already_enrolled array

        $slot = strtoupper($_POST['slot']); //compare it with $will_clash array

        $credits = (int)$_POST['credits'] + $enrolled_credits;  //add previous credits to future credits

        #checking credits
            if($credits>28){
                echo "credits exceeding";
                die();
            }else{
                    #checking duplication of courses
                   for($i=0;$i<count($already_enrolled);$i++){
                    if($coursecode==$already_enrolled[$i]){
                        echo "already enrolled";
                        die();
                    }   
                   }      
                         

                  #checking clashing. By comparing slots
                  
                    for($i=0;$i<count($will_clash);$i++){
                          if($slot==$will_clash[$i]){
                              echo "clashing";
                              die();
                         }
                    }
                      
                    #----------------------------
                    #no clashes or errors occured so push coursecode into $already_enrolled and push slot to $will_clash

                        #pushing coursecode
                        array_push($already_enrolled,$coursecode);
                        
                        #if the slot is combinational length will be >4
                     
                        if(strlen($slot)>4){
                            if($slot=="S4+L2"){
                                array_push($will_clash,"S4","S2","S3","L4","L5","L2","S4+L2");
                            }
                            
                            if($slot=="S3+L4"){
                               array_push($will_clash,"S3","L2","L6","L8","L4","S5","S4","S3+L4");
                            }

                            if($slot=="S1+L3"){
                                array_push($will_clash,"S1","L8","L9","L3","S7","S8","S1+L3");
                            }

                            if($slot=="S2+L7"){
                                array_push($will_clash,"S2","L2","L6","L10","L7","S8","S7","S2+L7");
                            }

                            if($slot=="S5+L10"){
                                array_push($will_clash,"S5","L4","L5"."L9","L10","S2","S7","S5+L10");
                            }

                            if($slot=="S2+L8"){
                               array_push($will_clash,"S2","L2","L6","L10","L8","S1","S3","S2+L8");
                            }

                            if($slot=="S2+L5"){
                               array_push($will_clash,"S2","L2","L6","L10","L5","S4","S5","S2+L5");
                            }
                            if($slot=="S5+L6"){
                                array_push($will_clash,"S5","S2","L5","L6","L9","L4","S3","S5+L6");
                            }

                            if($slot=="S8+L2"){
                               array_push($will_clash,"S2","L2","L3","L1","L7","S3","S8","S8+L2");
                            }

                            if($slot=="S3+L9"){
                                array_push($will_clash,"S3","L2","L6","L8","L9","S1","S5","S3+L9");
                            }

                            if($slot=="S1+L2"){
                                array_push($will_clash,"S1","L8","L9","L2","S2","S3","S1+L2");
                            }

                            if($slot=="S8+L5"){
                               array_push($will_clash,"S8","L3","L1","L7","L5","S4","S5","S8+L5");
                            }
                        }
                        else{
                            //Allied Elective
                            if($slot=='A1'){
                                array_push($will_clash,"A1","L13","A4");
                            }

                            if($slot=='A2'){
                                array_push($will_clash,"A2","L13","L12","L11");
                            }

                            if($slot=='A3'){
                                array_push($will_clash,"A3","L4","L7","L14","L15","S7","S4","A4");
                            }

                            if($slot=='A4'){
                                array_push($will_clash,"A4","L13","A1","L15","A3");
                            }

                            //Normal Subject
                            if($slot=='S1'){
                                array_push($will_clash,"S1","L8","L9","S1+L3","S2+L8","S3+L9","S1+L2");
                            }

                            if($slot=='S2'){
                                array_push($will_clash,"S2","L2","L6","L10","S4+L2","S2+L7","S5+L10","S2+L8","S2+L5","S5+L6","S8+L2","S1+L2");
                            }

                            if($slot=='S3'){
                                array_push($will_clash,"S3","L2","L6","L8","S4+L2","S3+L4","S2+L8","S5+L6","S8+L2","S3+L9","S1+L2");
                            }
                            if($slot=='S4'){
                                array_push($will_clash,"S4","L4","L5","A3","S4+L2","S3+L4","S2+L5","S3+L9","S8+L5");
                            }

                            if($slot=='S5'){
                                array_push($will_clash,"S5","L4","L5","L9","S3+L4","S5+L10","S2+L5","S5+L6","S8+L5");
                            }

                            if($slot=='S6'){
                                array_push($will_clash,"S6");
                            }
                            
                            if($slot=='S7'){
                                array_push($will_clash,"S7","L3","L7","L10","A3","S1+L3","S2+L7","S5+L10");
                            }

                            if($slot=='S8'){
                                array_push($will_clash,"S8","L3","L1","L7","S1+L3","S2+L7","S8+L2","S8+L5");
                            }

                            if($slot=='L1'){
                                array_push($will_clash,"L1","S8");
                            }

                            if($slot=='L2'){
                                array_push($will_clash,"L2","S2","S3");
                            }

                            if($slot=='L3'){
                                array_push($will_clash,"L3","S7","S8");
                            }

                            if($slot=='L4'){
                                array_push($will_clash,"L4","S5","S4","A3");
                            }

                            if($slot=='L5'){
                                array_push($will_clash,"L5","S4","S5");
                            }

                            if($slot=='L6'){
                                array_push($will_clash,"L6","S2","S3");;
                            }

                            if($slot=='L7'){
                                array_push($will_clash,"L7","S8","S7","A1");
                            }

                            if($slot=='L8'){
                                array_push($will_clash,"L8","S1","S3");
                            }

                            if($slot=='L9'){
                                array_push($will_clash,"L9","S1","S5");
                            }

                            if($slot=='L10'){
                                array_push($will_clash,"L10","S7","S2");
                            }

                            if($slot=='L11'){
                                array_push($will_clash,"L11","A2");
                            }

                            if($slot=='L12'){
                                array_push($will_clash,"L12","A2");
                            }

                            if($slot=='L13'){
                                array_push($will_clash,"L13","A1","A2","A4");
                            }

                            if($slot=='L14'){
                                array_push($will_clash,"L14","A3");
                            }

                            if($slot=='L15'){
                                array_push($will_clash,"L15","A3","A4");
                            }

                   }
                   
             }

                array_push($enrolled_slots,$slot);#adding enrolled slot for filling automatic timetable 

                $will_clash = implode(",",$will_clash);
                $already_enrolled = implode(",",$already_enrolled);
                $enrolled_slots = implode(",",$enrolled_slots);
                #updating data to db
                $validated = mysqli_query($conn,"UPDATE validate SET will_clash='$will_clash',already_enrolled='$already_enrolled',enrolled_slots='$enrolled_slots',check_credits='$credits' WHERE vtu='$vtu'");
                if($validated){
                    $enrolled = mysqli_query($conn,"INSERT INTO course_enroll (vtu,ttsno,coursecode,slot) VALUES ('$vtu','$tts','$coursecode','$slot')");
                    if($enrolled){
                        echo "enrolled";
                    }
                }
                
     }

     #UNENROLL COURSE
     #remove coursecode and related slots from validate.
     if(isset($_POST['unenroll'])){
        include "../../main/connection.php";
        @session_start();
       if(isset($_SESSION['vtu'])){
        $vtu = $_SESSION['vtu'];
        $id = $_SESSION['vtu'];
       }
        else{
            if(isset($_SESSION['faculty']) && isset($_POST['vtu'])){
                $vtu = $id = $_POST['vtu'];
                $fac=$_SESSION['fid'];
                $fac = mysqli_query($conn,"SELECT * FROM stuprofile WHERE stuid='$vtu' AND mentorid='$fac'");
                if($fac==false){
                    die();
                }
            }
        }
        $slot = $_POST["slot"];
        $coursecode = $_POST['coursecode'];
        $credits = (int)$_POST['credits'];
        $getdetails = mysqli_query($conn,"SELECT * FROM validate WHERE vtu='$id'");
        if(mysqli_num_rows($getdetails)>0){
            $row = mysqli_fetch_assoc($getdetails);
            $will_clash = array();
            $already_enrolled = array();
            $will_clash = explode(",",$row['will_clash']); #contains clashing slots
            
            $already_enrolled = explode(",",$row['already_enrolled']); #contains previously enrolled courses.
      
            $enrolled_slots = explode(",",$row['enrolled_slots']);

            $l = count($already_enrolled);
                for($i=0;$i<$l;$i++){
                    if($coursecode==$already_enrolled[$i]){
                       $already_enrolled = array_diff($already_enrolled,[$already_enrolled[$i]]);
                        $exist=true;
                        break;
                    }
                }
                

            $enrolled_credits = (int)($row['check_credits'])-$credits;

             //Allied Elective
             if($slot=='A1'){
                 $will_clash = array_diff($will_clash,["A1","L13","A4"]);
            }
            if($slot=='A2'){
                $will_clash = array_diff($will_clash,["A2","L13","L12","L11"]);
            }
            if($slot=='A3'){
                $will_clash = array_diff($will_clash,["A3","L4","L7","L14","L15","S7","S4","A4"]);
            }
            if($slot=='A4'){
                $will_clash = array_diff($will_clash,["A4","L13","L15","A1","A3"]);
            }
        
            //Deleting Combinational slots
            if(strlen($slot)>4){
                if($slot=="S4+L2"){
                    $will_clash = array_diff($will_clash,["S4","L2","L4","L5","S2","S3","S4+L2"]);
            }
            if($slot=="S3+L4"){
                $will_clash = array_diff($will_clash,["S3","L2","L4","L6","L8","S5","S4","S3+L4"]);
            }
            if($slot=="S1+L3"){
                $will_clash = array_diff($will_clash,["S1","L8","L9","L3","S7","S8","S1+L3","S1+L3"]);
            }
            if($slot=="S2+L7"){
                $will_clash = array_diff($will_clash,["S2","L2","L6","L10","L7","S8","S7","S2+L7"]);
            }
            if($slot=="S5+L10"){
                $will_clash = array_diff($will_clash,["S5","L5","L4","L9","L10","S7","S2","S5+L10"]);
            }
            if($slot=="S2+L8"){
                $will_clash = array_diff($will_clash,["S2","L2","L10","L6","L8","S1","S3","S2+L8"]);
            }
            if($slot=="S2+L5"){
                $will_clash = array_diff($will_clash,["S2","L2","L5","L6","L10","S5","S4","S2+L5"]);
            }
            if($slot=="S5+L6"){
                $will_clash = array_diff($will_clash,["S5","L4","L5","L6","L9","S2","S3","S5+L6"]);
            }
            if($slot=="S8+L2"){
                $will_clash = array_diff($will_clash,["L3","S8","L1","L7","L2","S2","S3","S8+L2"]);
            }
            if($slot=="S3+L9"){
                $will_clash = array_diff($will_clash,["S3","L2","L8","L6","L9","S1","S5","S3+L9"]);
            }
            if($slot=="S1+L2"){
                $will_clash = array_diff($will_clash,["S2","L2","L8","S1","L9","S3","S1+L2"]);
            }
            if($slot=="S8+L5"){
                $will_clash = array_diff($will_clash,["S8","L3","L1","L7","L5","S5","S4","S8+L5"]);
            }
        }
        else{
  
            if($slot=='S1'){
                $will_clash = array_diff($will_clash,["S1","L9","L8","S1+L3","S3+L9","S2+L8","S1+L2"]);
                }
                if($slot=='S2'){
                    $will_clash = array_diff($will_clash,["S2","L2","L6","L10","S4+L2","S2+L7","S5+L6","S1+L2","S8+L2","S5+L10","S2+L8","S2+L5"]);
                }
                if($slot=='S3'){
                    $will_clash = array_diff($will_clash,["S3","L2","L6","L8","S4+L2","S3+L4","S2+L8","S5+L6","S8+L2","S3+L9","S1+L2"]);
                }
                if($slot=='S4'){
                  $will_clash = array_diff($will_clash,["S4", "L4", "L5", "A3", "S4+L2", "S3+L4", "S2+L5", "S3+L9", "S8+L5"]);
                }
                if($slot=='S5'){
                  $will_clash = array_diff($will_clash,["S5", "L4", "L5", "L9", "S3+L4", "S5+L10", "S2+L5", "S5+L6", "S8+L5"]);    
                }
                if($slot=='S6'){
                  $will_clash = array_diff($will_clash,["S6"]);
                }
                if($slot=='S7'){
                  $will_clash = array_diff($will_clash,["S7", "L3", "L7", "L10", "A3", "S1+L3", "S2+L7", "S5+L10"]);
                }
                if($slot=='S8'){
                  $will_clash = array_diff($will_clash,["S8", "L3", "L1", "L7", "S1+L3", "S2+L7", "S8+L2", "S8+L5"]);
                }
                if($slot=='L1'){
                  $will_clash = array_diff($will_clash,["L1", "S8"]);
                }
                if($slot=='L2'){
                  $will_clash = array_diff($will_clash,["L2", "S2", "S3"]);      
                }
                if($slot=='L3'){
                  $will_clash = array_diff($will_clash,["L3", "S7", "S8"]);  
                }
                if($slot=='L4'){
                  $will_clash = array_diff($will_clash,["L4", "S5", "S4", "A3"]);
                }
                if($slot=='L5'){
                  $will_clash = array_diff($will_clash,["L5", "S4", "S5"]);
                }
                if($slot=='L6'){
                  $will_clash = array_diff($will_clash,["L6", "S2", "S3"]);
                }
                if($slot=='L7'){
                  $will_clash = array_diff($will_clash,["L7", "S8", "S7", "A3"]);
                }
                if($slot=='L8'){
                  $will_clash = array_diff($will_clash,["L8", "S1", "S3"]);
                }
                if($slot=='L9'){
                  $will_clash = array_diff($will_clash,["L9", "S1", "S5"]);
                }
                if($slot=='L10'){
                  $will_clash = array_diff($will_clash,["L10", "S7", "S2"]);
                }
                if($slot=='L11'){
                  $will_clash = array_diff($will_clash,["L11", "A2"]);  
                }
                if($slot=='L12'){
                  $will_clash = array_diff($will_clash,["L12","A2"]);
                }
                if($slot=='L13'){
                  $will_clash = array_diff($will_clash,["L13", "A1", "A2", "A4"]);
                   
                }
                if($slot=='L14'){
                  $will_clash = array_diff($will_clash,["L14","A3"]);
                }
                if($slot=='L15'){
                  $will_clash = array_diff($will_clash,["L15","A3","A4"]);
                }
        }
        $enrolled_slots = array_diff($enrolled_slots,[$slot]);#removing from enrolled slot.

        $will_clash = implode(",",$will_clash);
        $already_enrolled = implode(",",$already_enrolled);
        $enrolled_slots = implode(",",$enrolled_slots);
        #updating db
        $validated = mysqli_query($conn,"UPDATE validate SET will_clash='$will_clash',already_enrolled='$already_enrolled',enrolled_slots='$enrolled_slots',check_credits='$enrolled_credits' WHERE vtu='$vtu'");
        if($validated){
            $enrolled = mysqli_query($conn,"DELETE FROM course_enroll WHERE vtu='$vtu' AND coursecode='$coursecode'");
            if($enrolled){
                echo "unenrolled";
            }
        }
           
    }      
}
?>
