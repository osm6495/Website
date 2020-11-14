<?php
session_start();
$DATABASE_HOST = '192.168.50.86';
$DATABASE_USER = 'user';
$DATABASE_PASS = 'Serverlab';
$DATABASE_NAME = 'db';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}

if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            //TODO: Better formating of welcome. Maybe save other data to db, such as IP, dateJoined, lastOnline, etc.
            echo 'Welcome ' . $_SESSION['name'] . '!';
        } else {
            //Incorrect Password TODO: Formatting
            echo 'Incorrect username and/or password!';
        }
    } else {
        //Incorrect Username TODO: Formatting
        echo 'Incorrect username and/or password!';
    }

	$stmt->close();
}
?>