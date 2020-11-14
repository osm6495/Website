<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'Serverlab';
$DATABASE_NAME = 'db';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Lab - Profile</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100;0,200;0,300;1,100;1,200;1,300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./homestyle.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <div class="logo-container">
                <li><a href="./index.html" class="logo">The Lab</h4></li>
            </div>
            <nav>
                <ul class="nav-links">
                    <li ><a class="nav-links" href="#">Guacamole</a></li>
                    <li ><a class="nav-links" href="#">Resume</a></li>
                    <li ><a class="nav-links" href="./logout.php">Log Out</a></li>
                </ul>
            </nav>
        </header>
        <div class="box-background">
            <form class="box" action="index.html" method="post">
                <h1>Welcome to The Lab</h1>
                <div class="text">
                    <p>User: <?=$_SESSION['username']?></p>
                    <p>Email: <?=$_SESSION['email']?></p>
                    <p>Password: [REDACTED]</p>
                </div>
                <li><a class="pass" href="./createaccount.html">Change Password</a></li>
            </form>
        </div>
    </body>
</html>