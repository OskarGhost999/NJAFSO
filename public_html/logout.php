<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
  </head>
  <body style="background-color: #e0f5f5;">
    <div id= container>
      <font size="7">
      <center><form name="loginform" id="myForm" method="POST"><br>
                <br>
          <br>
          <br>
          <br>
          <center style="font-size: 50px; position: relative; color:black; font-family: 'Poppins', sans-serif;" > You have logged out.</center><br>
          <button style="position: relative; bottom: 20px; padding: 40px 90px; font-size: 35px; font-family: 'Poppins', sans-serif;"class = "button" onclick="location.href = 'index.php';"
            type="button" name="Login"> Log Back In!</button>
  		</form></center>
    </div>
	</body>
</html>