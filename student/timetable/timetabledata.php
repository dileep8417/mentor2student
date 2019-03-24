<?php
    @session_start();
   
    if(isset($_SESSION['vtu'])){
        $vtu=$_SESSION['vtu'];
    }else if(isset($_SESSION['faculty']) && isset($_SESSION['tmpvtu'])){
        $vtu=$_GET['vtu'];
    }else{
        die();
    }
    $iterate = mysqli_query($conn,"SELECT * FROM validate WHERE vtu='$vtu'");
    if(mysqli_num_rows($iterate)>0){
        $enrolled = mysqli_fetch_assoc($iterate);
        $slots = $enrolled["enrolled_slots"];
        if($enrolled["enrolled_slots"]==" " || $enrolled["enrolled_slots"]==null || $enrolled["enrolled_slots"]==""){
            $slots = array();
        }else{
            $slots = explode(",",$slots);

            $len = count($slots);
    for($i=0;$i<$len;$i++){
        $slot = $slots[$i];
        $get_course_info = mysqli_query($conn,"SELECT * FROM course_enroll WHERE vtu='$vtu' AND slot='$slot'");
        $row = mysqli_fetch_assoc($get_course_info);
        $coursecode = $row['coursecode'];
        $tts = $row['ttsno'];
        $details = mysqli_query($conn,"SELECT * FROM courses WHERE coursecode='$coursecode' AND facultyname='$tts' AND slotno='$slot'");
        while($row2=mysqli_fetch_assoc($details)){
           $facultyname=$row2["facultyname"];
           $roomno=$row2["roomno"];
           $credits=$row2["credits"];
           $cat = $row2["coursecategory"];
           $course = $row2["coursename"];
        
        ?>
        var d=0;
        //Setting Slots as Matrix    
            var S1=['27','32','57'];
            var S2=['17','23','34'];
            var S3=['22','35','58'];
            var S4=['24','42','55'];
            var S5=['25','33','54'];
            var S6=['21','31','41'];
            var S7=['18','37','45'];
            var S8=['14','38','44'];
            var A1=['19','29','39'];
            var A2=['110','210','310'];
            var A3=['24','37','410','510'];
            var A4=['39','310','311','59','510'];
            var L1=['14','15'];
            var L2=['34','35'];
            var L3=['44','45'];
            var L4=['24','25'];
            var L5=['54','55'];
            var L6=['22','23'];
            var L7=['37','38'];
            var L8=['57','58'];
            var L9=['32','33'];
            var L10=['17','18'];
            var L11=['110','111'];
            var L12=['210','211'];
            var L13=['39','310'];
            var L14=['49','410'];
            var L15=['59','510'];
            var c1=['27','32','57'];
            var c2=['17','23','34'];
            var c3=['22','35','58'];
            var c4=['24','42','55'];
            var c5=['25','33','54'];
            var c6=['21','31','41'];
            var c7=['18','37','45'];
            var c8=['14','38','44'];
            
            var courseCode = "<?php echo @$coursecode?>";
            var choosedCourse = "<?php echo @$course?>";
            var choosedTeacher = "<?php echo @$facultyname?>";
            var roomno = "<?php echo @$roomno?>";
            var credit = "<?php echo @$credits?>";
            var selectedCategory = "<?php echo @$cat?>";
            var choosedSlot = "<?php echo @$slots[$i]?>";
           
                if(choosedSlot.length>4){
                                if(choosedSlot=="S4+L2"){
                                    var combArr=c4;
                                    for(add=0;add<L2.length;add++){
                                        combArr.push(L2[add]);
                                    }
                                }
                                if(choosedSlot=="S3+L4"){
                                    var combArr=c3;
                                    for(add=0;add<L4.length;add++){
                                        combArr.push(L4[add]);
                                    }
                                }
                                if(choosedSlot=="S1+L3"){
                                    var combArr=c1;
                                    
                                    for(add=0;add<L3.length;add++){
                                        combArr.push(L3[add]);
                                    }
                                    
                                }
                                if(choosedSlot=="S2+L7"){
                                    var combArr=c2;
                                    for(add=0;add<L7.length;add++){
                                        combArr.push(L7[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S5+L10"){
                                    var combArr=c5;
                                    for(add=0;add<L10.length;add++){
                                        combArr.push(L10[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S2+L8"){
                                    var combArr=c2;
                                    for(add=0;add<L8.length;add++){
                                        combArr.push(L8[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S2+L5"){
                                    var combArr=c2;
                                    for(add=0;add<L5.length;add++){
                                        combArr.push(L5[add]);
                                    }
                                    
                                }
                                if(choosedSlot=="S5+L6"){
                                    var combArr=c5;
                                    for(add=0;add<L6.length;add++){
                                        combArr.push(L6[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S8+L2"){
                                    var combArr=c8;
                                    for(add=0;add<L2.length;add++){
                                        combArr.push(L2[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S3+L9"){
                                    var combArr=c3;
                                    for(add=0;add<L9.length;add++){
                                        combArr.push(L9[add]);
                                    }
                                    
                                }
                                if(choosedSlot=="S1+L2"){
                                    var combArr=c1;
                                    for(add=0;add<L2.length;add++){
                                        combArr.push(L2[add]);
                                    }
                                
                                }
                                if(choosedSlot=="S8+L5"){
                                    var combArr=c8;
                                    for(add=0;add<L5.length;add++){
                                        combArr.push(L5[add]);
                                    }
                                    
                                }
                            }
                            else{
                                //Allied Elective
                                if(choosedSlot=='A1'){
                                    var arr=A1;
                                
                                }
                                if(choosedSlot=='A2'){
                                    var arr=A2;
                                
                                }
                                if(choosedSlot=='A3'){
                                    var arr=A3;
                                    
                                }
                                if(choosedSlot=='A4'){
                                    var arr=A4;
                                    
                                }
                                //Normal Subject
                            if(choosedSlot=='S1'){
                                var arr=[];
                                var arr=S1;
                                
                            }
                            if(choosedSlot=='S2'){
                                var arr=[];
                                var arr=S2;
                                
                            }
                            if(choosedSlot=='S3'){
                                var arr=[];
                                var arr=S3;
                            
                            }
                            if(choosedSlot=='S4'){
                                var arr=[];
                                var arr=S4;
                                
                            }
                            if(choosedSlot=='S5'){
                                var arr=[];
                                var arr=S5;
                                
                            }
                            if(choosedSlot=='S6'){
                                var arr=[];
                                var arr=S6;
                            
                            }
                            if(choosedSlot=='S7'){
                                var arr=[];
                                var arr=S7;
                                
                            }
                            if(choosedSlot=='S8'){
                                var arr=[];
                                var arr=S8;
                                
                            }
                            if(choosedSlot=='L1'){
                                var arr=[];
                                var arr=L1;
                                
                            }
                            if(choosedSlot=='L2'){
                                var arr=[];
                                var arr=L2;
                                
                            }
                            if(choosedSlot=='L3'){
                                var arr=[];
                                var arr=L3;
                                
                            }
                            if(choosedSlot=='L4'){
                                var arr=[];
                                var arr=L4;
                                
                            }
                            if(choosedSlot=='L5'){
                                var arr=[];
                                var arr=L5;
                                
                            }
                            if(choosedSlot=='L6'){
                                var arr=[];
                                var arr=L6;
                                
                            }
                            if(choosedSlot=='L7'){
                                var arr=[];
                                var arr=L7;
                                
                            }
                            if(choosedSlot=='L8'){
                                var arr=[];
                                var arr=L8;
                                
                            }
                            if(choosedSlot=='L9'){
                                var arr=[];
                                var arr=L9;
                                
                            }
                            if(choosedSlot=='L10'){
                                var arr=[];
                                var arr=L10;
                            
                            }
                            if(choosedSlot=='L11'){
                                var arr=[];
                                var arr=L11;
                            
                            }
                            if(choosedSlot=='L12'){
                                var arr=[];
                                var arr=L12;
                            
                            }
                            if(choosedSlot=='L13'){
                                var arr=[];
                                var arr=L13;
                                
                            }
                            if(choosedSlot=='L14'){
                                var arr=[];
                                var arr=L14;
                            
                            }
                            if(choosedSlot=='L15'){
                                var arr=[];
                                var arr=L15;
                            }
                            }
                            if(choosedSlot.length>4){
                                for(i=0;i<combArr.length;i++){
                                document.getElementById("box-"+combArr[i]).innerHTML=choosedCourse+"<br>"+courseCode+"<br>"+choosedTeacher+"<br>"+"Room no."+roomno+"<br>"+"slot-"+choosedSlot+"<span class='remove-icon text-danger'style='float:right;position:relative;right:5px;cursor:pointer'><i class='remove-icon fas fa-trash'></i></span>";
                                $("#box-"+combArr[i]).addClass("del"+d);
                                $("#box-"+combArr[i]).attr("data-credits",credit);
                                $("#box-"+combArr[i]).attr("data-category",selectedCategory);
                                $("#box-"+combArr[i]).attr("data-slot",choosedSlot);
                            }
                            }
                            else{
                                for(i=0;i<arr.length;i++){
                                document.getElementById("box-"+arr[i]).innerHTML=choosedCourse+"<br>"+courseCode+"<br>"+choosedTeacher+"<br>"+"Room no."+roomno+"<br>"+"slot-"+choosedSlot+"<span class='remove-icon text-danger'style='float:right;position:relative;right:5px;cursor:pointer'><i class='remove-icon fas fa-trash'></i></span>";
                                $("#box-"+arr[i]).addClass("del"+d);
                                $("#box-"+arr[i]).attr("data-credits",credit);
                                $("#box-"+arr[i]).attr("data-category",selectedCategory);
                                $("#box-"+arr[i]).attr("data-slot",choosedSlot);
                                $("#box-"+arr[i]).attr("data-ccode",courseCode);
                                $("#box-"+arr[i]).attr("data-course",choosedCourse);
                            }
                                d++;
                        }         
        <?php
        }
    }

        }  
    }
    
?>