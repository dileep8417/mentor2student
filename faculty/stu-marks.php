<?php
    if(isset($_GET['vtu'])){
        $vtu = $_GET['vtu'];
    }
?>

<html>
  <head></head>
  <body>
    <style>
       .disp{
           padding:5px;
           margin-top:15px;
           overflow-X:auto;
       }
       .disp table{
         width:100vw;
       }
       table tr{
          background:#b8e994;
       }
    </style>
        <div class="disp"><h3 class="tmp text-primary">please wait.... Fetching Data.</h3></div>
   
        
    <script>

    function makeApiCall() {
      var params = {
        
        spreadsheetId: '1ftDp9vQvelvy5pa3mGsAHSoRO9c8Nz2AdheQYUlJDfg',  
        range: 'Sheet1' 
      };

       var request = gapi.client.sheets.spreadsheets.values.get(params);
       request.then(function(response) {
        var obj =response.result.values;
        var tb = "<table class='table'>";
        tb+="<tr class='bg-warning text-white text-center'><th>Coursecode</th><th>Course</th><th>Unit-1 (10)</th><th>Unit-2 <br>(10)</th><th>Mid-Test-1 <br>(20)</th><th>Mid-Test-2 <br>(20)</th><th>Ass-1 <br>(5)</th><th>Ass-2 <br>(5)</th><th>No. of periods present <br>(30/45/50)</th><th>Attendance (5)</th><th>Internals <br>(40)</th><th>Condition</th></tr>";
        for(i=0;i<obj.length;i++){
            tb+="<tr class='text-center'>";
            for(j=1;j<obj[0].length-3;j++){    
                  if(obj[i][0]=="<?php echo $vtu?>"){                  
                    tb+="<td>"+obj[i][j]+"</td>";
                 }
            }
           

            //calculating internals
                    //for unit-1 & unit-2
                    if(obj[i][0]=="<?php echo $vtu?>"){
                      var unit1 = obj[i][3];
                      var unit2 = obj[i][4];
                      var mid1 = obj[i][5];
                      var mid2 = obj[i][6];
                      var ass1 = obj[i][7];
                      var ass2 = obj[i][8];
                      var att = obj[i][9];
                      var internal =0;
                      var condition;
                    if(unit1=="" || unit1==undefined || unit1=="AB" || unit1=="-"){
                        unit1=0;
                    }
                    if(unit2=="" || unit2==undefined || unit2=="AB" || unit2=="-"){
                        unit2=0;
                    }
                  
                      if(unit1>unit2){
                        unit1*=2/3;
                        unit2*=1/3
                      }else{
                        unit2*=2/3;
                        unit1*=1/3;
                      }
                    
                    var unit = parseFloat(unit1)+parseFloat(unit2);
                   
                    //for mid-1 & mid-2
                    if(mid1=="" || mid1==undefined || mid1=="AB" || mid1=="-"){
                        mid1=0;
                    }
                    if(mid2=="" || mid2==undefined || mid2=="AB" || mid2=="-"){
                        mid2=0;
                    }
                   
                      if(mid1>mid2){
                        mid1*=2/3;
                        mid2*=1/3
                      }else{
                        mid2*=2/3;
                        mid1*=1/3;
                      }
                    
                    var mid = parseFloat(mid1) + parseFloat(mid2);
                    
                    //for attendance
                      //for normal subjects
                      //for labs
                      if(unit1=="" && unit2=="" && mid1=="" && mid2==""){
                        //may be labs
                        //no need to add attendance to internals
                        if(ass1=="" || ass1==undefined || ass1==" " || ass1=="-"){
                            ass1  = 0;
                        }
                        if(ass2=="" || ass2==undefined || ass2==" " || ass2=="-"){
                            ass2  = 0;
                        }
                        var assignment= internal = parseFloat(ass1)+parseFloat(ass2);
                        console.log("Lab subjects "+internal)
                      }else{
                        //may be normal sub
                        if(att=="" || att==undefined){
                              att==0;
                          }
                          if(att!=0){
                              att=parseFloat((att/45)*100);
                          }
                          if(att>89){
                            att=5;
                          }
                          else if(att>79){
                            att=4;
                          }
                          else if(att>74){
                            att=3;
                          }else{
                            att=0;
                          }
                          //assignment
                          if(ass1=="" || ass1==undefined || ass1=="-" || ass1==" "){
                            ass1  = 0;
                          }
                          if(ass2=="" || ass2==undefined || ass2=="-" || ass2==" "){
                              ass2  = 0;
                          }
                          
                         if(ass1>ass2){
                            ass = ass1*2/3 + ass2*1/3;
                         }else{
                           ass = ass2*2/3 + ass1*1/3;
                         }
                          //calculation
                          internal = Math.round(unit + mid + att + ass);
                          console.log("Unit = "+unit+" midterm = "+mid+" attendance = "+att+" assignment = "+ass);
                      }
                    
                   
                      tb+="<td id='attend'>"+att+"</td>";
                      tb+="<td id='internal'>"+internal+"</td>";
                      if(att>2){
                          condition="Eligible";
                          tb+="<td id='cond' class='bg-success text-white'>"+condition+"</td>";
                        }
                        else{
                          condition="Not-Eligible";
                          tb+="<td id='cond'  class='bg-danger text-white'>"+condition+"</td>";
                        }
                      
            tb+="</tr>";
            
        }
        }
           tb+="</table>";
           $(".disp").html(tb);
      },
       function(reason) {
          console.error('error: ' + reason.result.error.message);
      });
    }

  
    function initClient() {
      var API_KEY = 'AIzaSyA91Fyym6IXJQfp-IIIqT4ONNYeuWoWG3k';  

      var CLIENT_ID = '903244503101-kk1qs6bq2g6fkk2ins5rm79014cpfovg.apps.googleusercontent.com'; 
      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly';

      gapi.client.init({
        'apiKey': 'AIzaSyA91Fyym6IXJQfp-IIIqT4ONNYeuWoWG3k',
        'clientId': '903244503101-kk1qs6bq2g6fkk2ins5rm79014cpfovg.apps.googleusercontent.com',
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }
    

    function updateSignInStatus() {
        makeApiCall();
    }
   
      
    </script>
<script async defer src="https://apis.google.com/js/api.js">
    </script>
   <script>
    setTimeout(function(){
            $("#details-holder").css("display","block");
            $(".loader").css("display","none"); 
            handleClientLoad();  
        },1000);
   </script>
  </body>
</html>