<?php
    @session_start();
    $id = $_SESSION['tmpstuid'];
    include "../main/connection.php";
    include "../main/headfiles.php";
    if(isset($_GET['vtu'])){
        $uname = $_GET['vtu'];
        $query = "SELECT * FROM stuprofile WHERE stuid='$uname' AND id='$id'";
        $res = mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
        ?>
            <head>
                <style>
                    body,html{
                        width:100%;
                        height:100%;
                        overflow:hidden;
                    }
                    #chgpass-frame{
                        width:30vw;
                        min-width:350px;
                        height:200px;
                        background:white;
                        border-radius:10px;
                        box-shadow:2px 3px 5px black;
                        position:relative;
                        display:block;
                        margin:auto;
                        top:20vh;
                        padding:15px;
                    }
                    #chgpass-frame table tr td input{
                        border-radius:1px;
                        height:25PX;
                    }
                    #chgpass-frame table{
                        position:relative;
                        left:50%;
                        transform:translateX(-50%);
                        padding:10px;
                    }
                    #chgpass-frame table tr td{
                        padding:10px;
                    }
                    table{
                       
                    }
                </style>
            </head>
            <body>
                <div id="chgpass-frame">
                    <img class="loader" src="images/password.gif" style="display:none;position:absolute;width:90px;z-index:100;top:-10px;left:-10px;;" alt="">
                    <div class="head"><h3 style="text-align:center">Change Password</h3></div>
                    <div class="body">
                                <table>
                                <tr>
                                    <td>
                                    Password:
                                    </td>
                                    <td>
                                    <input type="password" id="pass" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Re-Password:</span>
                                    </td>
                                    <td>
                                    <input type="password" id="repass" required>
                                    </td>
                                </tr>
                            </table>

                            <button class="btn btn-info" style="display:block;position:relative;left:50%;transform:translateX(-50%);">Change</button>
                </div>
                <h4 class="ptext text-danger" style="position:relative;top:65%;z-index:100"></h4>
                </div>
                <script>
                    $("button").click(function(){
                        var p = $("#pass").val();
                        var rp = $("#repass").val();
                        if(p.length<4){
                            alert("password must be morethan 4 charecters");
                        }else if(p!=rp){
                            alert("Password and RE-Password not matched");
                        }else{
                            $(".body").css("display","none");
                            $(".loader").css("display","block");
                            $(".ptext").html("Changing...");
                            $.ajax({
                                url:"student/verify.php",
                                type:"POST",
                                data:{
                                    changepass:true,
                                    vtu:"<?php echo $uname?>",
                                    pass:p.trim()
                                },
                                success:function(resp){
                                    var r = resp.trim();
                                    console.log(r)
                                    if(r=="changed"){
                                        alert("Password Changed");
                                        location.href="index.php";
                                    }else{
                                        alert("Something wrong please try again...");
                                        $(".body").css("display","block");
                                         $(".loader").css("display","none");
                                         $(".ptext").text(" ");
                                    }
                                }
                            });
                        }
                    });
                </script>
            </body>
            </html>
        
        <?php
        
    }else{
        echo "<h2 style='color:red'>Something Wrong..</h2>";
    }
}else{
    echo "<h2 style='color:red'>VTU not set..</h2>";
}
?>
<script>
     $(document).ready(function(){
                        $(".loader").fadeOut(300);
                        $(".container").css("display","block");
                    });
</script>