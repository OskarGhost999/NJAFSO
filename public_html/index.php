<?php
	require("config.php");
	session_start();
?>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<link rel = "stylesheet" href = "includes/styleTemplate.css">
    <style>
        .heart
        {
            position:absolute;
            top: -153px;
            left: -33px;
            width:50px;
            height:150px;
            margin:175px;
            opacity:.8;
        }
        
        .heart:before,.heart:after
        {
            position: absolute;
            content: "";
            width: 20px;
            height:32px;
            background :red;
            border-radius:50px 50px 0 0;
            margin-left: .5rem !important;
            margin-right: .5rem !important;
        }
        .heart:before{
            left:30px;
            -webkit-transform:rotate(-45deg);
            transform:rotate(-45deg);
            -webkit-transform-origin:0 100%;
            transform-origin:0 100%;
        }
        .heart:after{
            left: 16px;
            top: -14px;
            -webkit-transform:rotate(45deg);
            transform:rotate(45deg);
            -webkit-transform-origin:0 100%;
            transform-origin:0 100%;
        }
		body {
			background-image: url("https://lh3.googleusercontent.com/_uLtK2p65lwRVcqkAa-jenk95kdYIGr9-tHHh3rJnHLXsWzjHf6mgEOZFqykyFr7XtLSVsk_aBjOmS-ZMb8=s1600");
			height: 100%;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			color: #bcbdbe;
		}
		.card {
			position: absolute;
			margin: auto;
			vertical-align: center;
			padding: 3em;
			border-radius: 1em;
			background-color: rgba(255, 255, 255, 0.8);
			color: black;
		}
		.formarea {
			position: absolute;
			top: 50%;
			left: 50%;
		}
	</style>
	<body>
		<div class="h-100">
			<nav class="navbar navbar-expand-lg navbar-dark bg-light" style="font-family: sans-serif; font-size: 120%; background-color: #36096d; background-image: linear-gradient(315deg, rgb(0,75,114), rgb(0,118,181), rgb(0,75,114));">
        	    <a class="navbar-brand" style ="font-size: 35px; margin-right: 3rem; font-family: 'Poppins', sans-serif; "><b>NJAFSO</b></a>
        	    <div class="heart"></div>
        	</nav>
			<div class="d-flex align-items-center justify-content-center text-center formarea">
				<div class="card text-center">
					<div class="card-body">
						<h1 class="display-4">NJAFSO</h1>
						<form class="form" name="loginform" id="myForm" method="POST">
							<h4>Login</h4>
							<br>
							<div class="form-row">
								<input class = "form-control formInput1" type="username" id="username" name="username" placeholder="Enter Username"/>
							</div>
							<div class="form-row">
								<input class = "form-control formInput2" type="password" id="pass" name="password" placeholder="Enter Password"/><br>
							</div>
							<br>
							<div class="form-row text-center">
								<input class="form-control btn btn-primary" type="submit" value="Login"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- <center class="navbar">
		<font class="logo"> NJAFSO </font>
		<font class="Sub">New Jersey Alliance of Family Support Organizations</font>
		</center>
		<div id= "container">
			<font size="9">
			<center><form name="loginform" id="myForm" method="POST">
				<center style="position: relative; bottom: 80px; font-family: 'Montserrat', sans-serif; color:white" > Login </center>
				<input class = "formInput1" type="username" id="username" name="username" placeholder="Enter Username"/><br>
				<input class = "formInput2" type="password" id="pass" name="password" placeholder="Enter Password"/><br>
				<input class= "button" type="submit" value="Login"/>
			</form></center>
		</div> -->
	</body>
</html>


<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 1);

	if(isset($_POST['username']) && isset($_POST['password'])){
		$pass = $_POST['password'];
		$username = $_POST['username'];
		//$pass = password_hash($pass, PASSWORD_BCRYPT);

		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		$db = new PDO($connection_string, $dbuser, $dbpass);

		Try{
			$stmt = $db->prepare("SELECT username, password, id, role from `users` where username = :username LIMIT 1");
			$params = array(":username"=> $username);
			$stmt->execute($params);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		catch(Exception $e){
			echo $e->getMessage();
			exit();
		}

		//var_dump($result);
		//finally{}
		if($result){
			$userpassword = $result['password'];
			if(password_verify($pass, $userpassword)){
				$_SESSION['role'] = $result['role'];
				$_SESSION['ID'] = $result['id'];
				echo "<script> ; window.location.href='home.php'; </script>";
				//echo'<html><script type="text/javascript">window.open("register.php","_self");</script></html>';
				//header("Location: register.php");
			}
			else{
			$message = "Username and/or Password incorrect.\\nTry again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		else{
			$message = "Username and/or Password incorrect.\\nTry again.";
			echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
?>
