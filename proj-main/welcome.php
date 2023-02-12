<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) 
    {
        header("Location: index.php");
        die();
    }

    include 'config.php';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) 
    { 
        $row = mysqli_fetch_assoc($query);

        //echo "Welcome " . $row['name'] . " <a href='logout.php'>Logout</a>"; 
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="" type="text/css" media="all" />
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Roboto Slab', serif;
        } 

        body {
            background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(./images/wallpaperflare.com_wallpaper.jpg);
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        ul {
            float: right;
            list-style-type: none;
            margin-top: 70px;
        }

        ul li {
            display: inline-block;
        }

        ul li a {
            text-decoration: none;
            color: #fff;
            padding: 5px 20px;
            border:  1px solid transparent;
            transition: 0.6s ease; 
        }

        ul li a:hover {
            background-color: #fff;
            color: #000;   
        }

        ul li.active a {
            background-color: #fff;
            color: #000;
        }

        .logo img{
            float: left;  
            width: 200px;
            height: auto;
        }

        .main {
            max-width: 1200px;
            margin: auto;
        }

        .title {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }

        .title h1 {
            color: #fff;
            font-size: 70px;
        }

        .button {
            position: absolute;
            top: 60%;
            left: 50%;
            transform: translate(-50%,-50%);
        }

        .btn {
            border: 1px solid #fff;
            padding: 10px 30px;
            color: #fff;
            text-decoration: none;
            transition: 0.6s ease;
        }
        
        .btn:hover {
            background-color: #fff;
            color: #000;
        }

    </style>
</head>
<body >
    <header>  
        <div class="main">
            <div class="logo">
                <img src="./images/1.png" alt="">
            </div>
            <ul>
                <li class="active"><a href="#">Test</a></li>
                <li><a href="#">Test</a></li>
                <li><a href="#">Test</a></li>
                <li><a href="#">Test</a></li>
            </ul>
        </div>

        <div class="title">
            <h1>Welcome, <?php echo $row['name'] ?> </h1>
        </div>

        <div class="button">
            <a href="#" class="btn">Test</a>
            <a href="logout.php" class="btn">Log Out</a>
        </div>

    </header>  
</body>
</html>