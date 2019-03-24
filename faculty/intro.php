<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">  
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
    <style>
        *{
            box-sizing:border-box;
            margin:0px;
            padding:0px;
            color:white;
            overflow:hidden;
        }
        .intro{
            width:100vw;
            height:80vh;
            background:#130f40;
            position:absolute;
            z-index:10;
            animation:anime1 1s linear;
        }
        .heading{
            position:relative;
            top:15vh;
            left:5vw;
            font-size:6vmin;
        }
        .intro h3,.lead{
            position:relative;
            top:18vh;
            left:2vw;
            font-size:3vmin;
        }
        #intro-close{
            cursor:pointer;
        }
        .intro-btn1{
            position:relative;
            top:25%;
           display: block;
           margin: auto;
        }
        .intro-btn2{
            position:relative;
            top:26%;
            display: block;
           text-align: center;
        }
        
        @media(min-width:760px){
            .intro{
                width:60vw !important;
                top:30vh;
                left:50%;
                padding:15px !important;
            }
        }
        @keyframes anime1{
            from{top:-100%}
        }
        @keyframes anime2{
            from{top:50%}
            to{top:-100%}
        }
    </style>
</head>
<body>
        <div class="intro">
            <h1 class="heading">Mentor Management System</h1>
            <h3>Instructions</h3>
            <p class="lead"><span class="text-primary">STEP-1:- </span>Add Your Mentees From <span class="tex-info">ADD MENTEE</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-2:- </span>You Can Find Your Mentees From <span class="tex-info">MY MENTEE</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-3:- </span>Update Your Mentees Marks From <span class="tex-info">MANAGE RESULTS</span> Section</p>
            <p class="lead"><span class="text-primary">STEP-4:- </span>You Can Find All Your Mentees Details From <span class="tex-info">ADD MENTEE</span> Section</p>
            <button class="btn btn-info understand .intro-btn1">Proceed</button>
            <a href="#" class="text-warning dont-show .intro-btn2">Don't show this again</a>
        </div>
    <script>
   
        $("#intro-close").click(function(){
            $(".intro").hide(500);
        });
        $(".understand").click(function(){
            $(".intro").hide(500);
        });
        $(".dont-show").click(function(){
            $.ajax({
                url:"logindb.php?intro=1",
                type:"GET",
                success:function(){
                    $(".intro").hide(500);
                }
            });
        });
    </script>
</body>
</html>