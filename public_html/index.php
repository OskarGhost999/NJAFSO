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
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
   <style>
       #container{
             width: 350px;
             height: 450px;
             background: inherit;
             position: absolute;
             overflow: hidden;
             top: 50%;
             left: 50%;
             margin-left: -175px;
             margin-top: -150px;
             border-radius: 8px;
           }
       #container:before{
             width: 400px;
             height: 550px;
             content: "";
             position: absolute;
             top: -25px;
             left: -25px;
             bottom: 0;
             right: 0;
             background: inherit;
             box-shadow: inset 0 0 0 200px rgba(255,255,255,0.2);
             background-color: #497288;
             filter: blur(18px);
           }
           .navbar {
              display: flex;
              align-items: center;
              padding: 20px;
              background-color: #F0EAD6;
              color: #fff;
              border-radius: 10px;
              border-style:outset;
              border-color: #ffc107;
              flex-direction: column;
           }
           form{
             text-align: center;
             position: absolute;
             left: 50%;
             top: 50%;
             transform: translate(-50%,-50%);
           }
           .logo {
             font-size: 72px;
             font-family: 'Poppins', sans-serif;
             color: #004060;
             background-color: #F0EAD6;
             width: 100%;
           }
       body{
            background-image: url("https://lh3.googleusercontent.com/_uLtK2p65lwRVcqkAa-jenk95kdYIGr9-tHHh3rJnHLXsWzjHf6mgEOZFqykyFr7XtLSVsk_aBjOmS-ZMb8=s1600");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            color: #bcbdbe;
            }
           .button {
             background-color: #0077B6;
             border: 3px outset #ffc107;
             color: white;
             padding: 15px 19px;
             text-align: center;
             text-decoration: none;
             display: inline-block;
             font-size: 16px;
             font-family: 'Montserrat', sans-serif;
             position: relative; top:0px;

             background-repeat:no-repeat;
             background-position:bottom left;
             background-position:bottom left, top right, 0 0, 0 0;
             background-clip:border-box;

             -moz-border-radius:8px;
             -webkit-border-radius:8px;
             border-radius:8px;

             -moz-box-shadow:0 0 1px #fff inset;
             -webkit-box-shadow:0 0 1px #fff inset;
             box-shadow:0 0 1px #fff inset;
           }

           .formInput1{
             width: 100%;
             padding: 10px;
             border: 2px solid #ffc107;
             border-radius: 25px;
             box-sizing: border-box;
             resize: vertical;
             position: relative; bottom:50px;
             font-family: 'Montserrat', sans-serif;
           }
           .formInput2{
             width: 100%;
             padding: 10px;
             border: 2px solid #ffc107;
             border-radius: 25px;
             box-sizing: border-box;
             resize: vertical;
             position: relative; bottom:40px;
             font-family: 'Montserrat', sans-serif;
           }
           .label {
             padding: 12px 12px 12px 0;
             display: inline-block;
           }
           .Sub{
             font-family: 'Montserrat'; 
             font-size:30px;
             color: #004060;
             background-color: #F0EAD6;
           }
         }
  </style>
  <body>
    <center class="navbar">
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
    </div>
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
		 $stmt = $db->prepare("SELECT username, password, id, role, fso_id from `users` where username = :username LIMIT 1");
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
            $_SESSION['fso_id'] = $result['fso_id'];
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