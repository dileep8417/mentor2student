<?php include "../main/headfiles.php";$vtu="vtu8698"?>
<html>
  <head></head>
  <body>
        <div class="disp"></div>
   
   
    <script>
    function makeApiCall() {
      var params = {
        
        spreadsheetId: '1FaLBSByIIlx-ZrYSxhRPi5UgQer32cTnwPrsMgIIfbg',  
        range: 'Sheet1' 
      };

       var request = gapi.client.sheets.spreadsheets.values.get(params);
       request.then(function(response) {

        var obj =response.result.values;
        console.log(obj);
            
        

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
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
   
  </body>
</html>