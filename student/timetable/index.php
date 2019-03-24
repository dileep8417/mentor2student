<?php
    include "../../main/connection.php";
    include "../../main/headfiles.php";
    @session_start();
    $mname = ucfirst($_SESSION['mname']);
    $mid = $_SESSION['mid'];
    $sem = $_SESSION['sem'];
    $vtu = $_SESSION['vtu'];
?>
<style>
@import url('https://fonts.googleapis.com/css?family=Catamaran');

    body{
        overflow-x:hidden;
    }
   select{
       width:25vw !important;
       min-width:240px;
       padding:5px;
      border-radius:7px;
   }
  .ddlist tr{
      padding:10px;
  }
  .content{
      top:30px;
  }
    .main ul{
        position:relative;
        top:7px;
    }
    table .tab-row:nth-child(even){
        background:#ffffff;
    }
    table .tab-row:nth-child(odd){
        background:#dfe6e9;
    }
    .overview table th{
        color:#e55039;
    }
   
    table .tab-row:nth-child(1){
        text-align:center;
    }
    .overview table tbody tr:nth-child(odd){
        background:#fad390;
    }
    .ddlist tr td:nth-child(odd){
        color:blue;
        font-size:17px !important;  
    }
    .ddlist tr td:nth-child(even){
        font-size:13px !important; 
    }
   select{
       padding:4px;
       margin-bottom:4px;
   }
    .hide{
        display:none;
    }
    
    .overview{
        width:100%;
    }
    *{
        list-style-type:none;
    }
    .content,table tr td,table tr th{
        font-size:2.5vmin;
    }
    #test{
        width:90vw;
        margin-bottom:20px;
    }
   .main{
       font-size:3vmin;
   }
   .overview,#test tr td,#test tr th{
        width:100vw;
        height:auto;
        font-size:2.4vmin;
    }
    .ttable{
    width:95vw;
    font-size:2.4vmin;
   }
   .ddlist tr td:nth-child(odd){
        font-weight:bold;
        color:black !important;
   }
  .close{
      cursor:pointer;
  }
</style>
</head>
<div class="container-fluid" style="font-family: 'Catamaran', sans-serif;">
<b><p class="lead" style="position:relative;top:60px"><span class="text-warning" style="font-weight:bolder">NOTE: </span><span class="text-info"><b>Independent Learning,international</b></span><b> and <span class="text-info">Value added</span> courses won't be displayed in timetable.</b></p></b>
<div class="msg" style="position:absolute"></div><br><br>
   <!-------------Re-Registration-------------->
        <button class="btn btn-info" id="re-reg-btn" style="position:relative;float:right;right:5vw;margin-right:10px;">Re-registration</button>

<br>
<h2 class="text-danger" style="position:relative;margin-top:100px;left:5px;margin-bottom:25px;font-size:5vmin">Enroll Courses</h2>

    <!--------------------------------Dropdown boxes-------------------------------->
<div id="course-info">
<table class="ddlist main" style="position:relative;left:10px">
<tr>
<td style="font-size:2.8vmin">Select Category:</td>
<td>
<select name="" id="courseCategory" onchange="category()">
    <option value="">Select category</option>
    <?php
        $query="SELECT DISTINCT coursecategory FROM courses";
        $res=mysqli_query($conn,$query);
        while($row=mysqli_fetch_assoc($res)){
            $course_category=$row['coursecategory'];
            ?>
            <option value="<?php echo  $course_category?>"><?php echo  $course_category?></option>
            <?php
        }
    ?>
</select>
</td>
</tr>

    <tr>
        <td  style="font-size:2.8vmin">Select Course :</td>
         <td><select  name="" id="selectCourse" onchange="courses()">
                  <option value="">Select Course</option>
            </select></td>
    </tr>

    <tr>
         <td  style="font-size:2.8vmin">Select Faculty :</td>
         <td><select name="" id="selectTeacher" onchange="teacherslots()">
                 <option value="">Select Faculty</option>
                </select></td>
    </tr>

    <tr>
       <td  style="font-size:2.8vmin">Select Slot :</td>
       <td><select name="" id="slot">
       <option value="">Select Slot</option>
</select>
</td>
 </tr>
 <tr>
     <td colspan='4' class="text-center">
     <button onClick="check()" class="btn btn-danger btn-md" style="margin-top:20px;color:white;box-shadow:2px 3px 7px black;margin-bottom:7px;width:145px">Enroll</button>

     </td>
 </tr>
    </table>
    <!---------------------------------------------------------------->
    </div>
<br>
<br>
        <!------------------------re-registration--------------------------->
<div class="re-reg-window" style="display:none;position:absolute;width:35vw;min-width:350px;height:250px;background:white;border-radius:15px;box-shadow:1px 2px 5px black;top:50%;left:50%;transform:translate(-50%,-50%);z-index:400">
                            <div class="close" style="float:right;margin-right:10px;padding:10px;">X</div>
                            <h4 class="text-danger text-center" style="padding:15px">Re-Registration Process</h4>
                           <img src="../images/sub-loader.gif" class="sub-loader" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:150px;z-index:100;display:none" alt="">
                           <img src="../images/success.png" class="sub-loader" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);width:150px;z-index:100;display:none" alt="">
                            <div class="reregbody" style="position:relative;top:4px;padding:2px;">
                            <p class="lead text-info text-center"><b>Select No. of courses need to re-register</b></p>
                                    <select  id="re-sub" style="width:80%;outline:none;display:block;margin:auto">
                                        <option value="">Select no. of subjects</option>
                                        <?php
                                            for($i=1;$i<=6;$i++){
                                                ?>
                                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <button class="btn btn-primary" id="re-reg-procees1" style="display:block;margin:auto;position:relative;top:45px;width:115px;">Proceed</button>
                            </div>
                            <button class="btn btn-success" id="re-reg-procees2" style="display:none;margin:auto;position:relative;width:115px;">Submit</button>
                        </div>

        <!----------------------------------------------------->

<!-------------------------------------Timetable planner-------------------------------------------->

<p class="lead text-primary" style="font-size:18px;margin-bottom:-20px;"><b>Enrolled Courses</b></p>
<div class="courses" style="padding:25px;">
        <?php include "../../faculty/unenroll.php"?>
</div>
        <!------------------------------------Timetable---------------------------------------->


<!---------Buttons---------------->
<button class="save-btn btn btn-success" onclick="exportToExcel('test')" style="float:right;position:relative;right:10vw;top:-4px;box-shadow:3px 3px 3px black">Download</button>
        <!------------------------------------>

<!------------------------------------------Main------------------------------------>
         <?php include "timetable-frame.php"?>
 
</div>
</div>
<script>
    $(document).ready(function(){
        $(".faculty-search-holder").css("display","none");
    });

    <?php include "timetabledata.php"?>
  
//----------------------------------------------

function category(){
    var category=$("#courseCategory").val();
   var xmlobj=new XMLHttpRequest();
         xmlobj.open("GET","timetable/info.php?category="+category,false);
   xmlobj.send(null);
    $("#selectCourse").html(xmlobj.responseText);
}
function courses(){
    var courses = $("#selectCourse").val();
    var xmlobj=new XMLHttpRequest();
    xmlobj.open("GET","timetable/info.php?courses="+courses,false);
    xmlobj.send(null);
    $("#selectTeacher").html(xmlobj.responseText);
}
function teacherslots(){
    var course = $("#selectCourse").val();
    var facuilty = $("#selectTeacher").val();
    var xmlobj=new XMLHttpRequest();
    xmlobj.open("GET","timetable/info.php?course="+course+"&facuilty="+facuilty,false);
    xmlobj.send(null);
    $("#slot").html(xmlobj.responseText);
}
    
//--------------------------------------------------------

    var course = document.getElementById("selectCourse");
    var selectTeacher = document.getElementById("selectTeacher");
    var slot = document.getElementById("slot");
      
        function check(){
            arr=0;
            combArr=0;

            //GETTING VALUES FROM INPUT FIELDS
            var choosedCourse=course.value;
            var choosedTeacher=selectTeacher.value;
            var choosedSlot=slot.value;
            if(choosedCourse=="" || choosedTeacher=="" || choosedSlot==""){
                alert("Enter all Fields");
                return;
            }else{
                $(".loader").css("display","block");
                var i=slot.selectedIndex;
                var courseCode=slot.options[i].getAttribute("data-coursecode");
                var roomno=slot.options[i].getAttribute("data-roomno");
                var credit=slot.options[i].getAttribute("data-credits");
                var selectedCategory=course.options[i].getAttribute("data-category");

                //SENDING DATA
                $.ajax({
                    url:"timetable/validate.php",
                    type:"POST",
                    data:{
                        enroll:true,
                        vtu:"<?php echo $vtu?>",
                        tts:choosedTeacher,
                        coursecode:courseCode,
                        credits:credit,
                        slot:choosedSlot
                    },
                    success:function(resp){
                        console.log(resp);
                        resp=resp.trim();
                        if(resp=="credits exceeding"){
                            $(".loader").css("display","none");
                            alert("Cannot enroll "+choosedCourse+" Enrolled credits will be more than 28.");
                        }
                        if(resp=="already enrolled"){
                            $(".loader").css("display","none");
                            alert("Warning: "+choosedCourse+" is already enrolled.");
                        }
                        if(resp=="clashing"){
                            $(".loader").css("display","none");
                            alert("Warning: "+choosedCourse+" is clashing.");
                        }
                        if(resp=="enrolled"){
                            alert("Success: "+choosedCourse+" is enrolled");
                            $(".content").load("timetable/index.php");    
                    }
                    }
                });
            }
        }
        

        $("td").on("click","i",function(){
            $(".loader").css("display","block");
                var cele = $(this).parent().parent();
                    var pele=cele.attr("class");
                    delcategory=$("."+pele).attr("data-ccode");
                    delslot=$("."+pele).attr("data-slot");
                    delcredit=$("."+pele).attr("data-credits");
                    delcourse=$("."+pele).attr("data-course");
                    if(confirm("Do You want to unenroll "+delcourse)){
                        $.ajax({
                        url:"timetable/validate.php",
                        type:"POST",
                        data:{
                            unenroll:true,
                            slot:delslot,
                            coursecode:delcategory,
                            credits:delcredit
                        },
                        success:function(resp){
                            console.log(resp)
                            resp=resp.trim();
                            if(resp=="unenrolled"){
                                $("."+pele).empty();
                                $("."+pele).removeClass();
                                alert(delcourse+" unenrolled");
                                $(".content").load("timetable/index.php");
                            }else{
                                alert("Something wrong");
                            }
                        }
                    });
                    }         
        });

    $(document).ready(function(){
        $(".content").css("display","block");
            $(".loader").fadeOut(300);
    });

    //export 2 excel
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
$("#re-reg-btn").click(function(){
    $(".re-reg-window").fadeIn(300);
    $("table").css("opacity",".3");

});

$(".close").click(function(){
    $(".re-reg-window").slideUp(300);
    $("table").css("opacity","1");
});
var n=0;
$("#re-reg-procees1").click(function(){
     n = $("#re-sub").val();
    if(n=="" || n.length==0){
        alert("Select the option for proceeding.");
    }
    else{
       $(".reregbody").load("../faculty/re-registration/reregprocess.php?n="+n);
       $('#re-reg-procees2').css("display","block");
    }
});

$('#re-reg-procees2').click(function(){
    for(i=1;i<=n;i++){
        if($("#sub"+i).val()==""){
            alert("Enter");
            return;
        }
    }
    $(".reregbody").css("display","none");
    $(".sub-loader").css("display","block");
    $(this).css("display","none");
    var arr = [];
    var sub;
    for(i=1;i<=n;i++){
        arr[i-1]=$("#sub"+i).val();
    }
    arr = arr.toString();
    $.ajax({
        url:"../faculty/re-registration/reregprocess.php",
        type:"POST",
        data:{
            sub:arr,
            rereg:true
        },
        success:function(resp){
            resp=resp.trim();
            if(resp=="sent"){
                $(".reregbody").css("display","none");
                $(".sub-loader").css("display","none");
                $(".success-img").css("display","block");
                $(".close").click();
                alert("Request sent to your Mentor");
                $(".content").load("timetable/index.php");
            }
            else{
                $(".reregbody").css("display","block");
                $(".sub-loader").css("display","none");
                $(this).css("display","block");
                $(".success-img").css("display","none");
                alert("Something wrong..");
            }
        }
    });
});

</script>


