<?php
    // session_start();
?>

<!DOCTYPE HTML>
<html lang="en">


<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="all.min.css">
    <style type="text/css">
        .brand-text{
            color: green !important;
            text-align: left !important;

        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
            
        }

        .tasktable{
            max-width: 750px;
            margin: 15px auto;
            padding: 15px;
        }
        th.taskwidth{
            width: 55%;
        }
    </style>

</head>
    <body class="grey lighten-4"> 
        <nav class="white z-depth-0">
            <div class="container">
                <!-- <a href="landingpage.php" class="brand-logo brand-text">Form Validation Exercise</a> -->
                <ul id="nav-mobile" class="left hide-on-small-and-down">
                    <li><a href="tasktable.php" class="btn z-depth-0">View Existing Tasks</a> </li>
                </ul>
                 <ul id="nav-mobile" class="right hide-on-small-and-down">
                    <li><a href="todoform.php" class="btn z-depth-0">Add A Task</a> </li>
                </ul>
            </div>
        </nav>

        
