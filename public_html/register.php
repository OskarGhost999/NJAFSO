<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 40px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
  <?php
      include_once('navbar.php');
  ?>
  <body style="background-color: #f5f1dff2;">
    <br>
    <bh>Register A New User</bh><br><br>
    <div class="col">
      <form name="RegisterForm" id="RegisterForm" method="POST">
        <label for="username">Username: </label>
        <input id="username" name="username" placeholder="Enter Username"/><br>
        <label for="password">Password: </label>
        <input id="password" type="password" name="password" placeholder="Password"/><br>
        <label for="FName">First Name: </label>
        <input id="FName" name="FName" placeholder="Enter First Name"/><br>
        <label for="LName">Last Name: </label>
        <input id="LName" name="LName" placeholder="Enter Last Name"/><br>
        <label for="cellPhone">Cell Phone:</label>
        <input type="tel" id="cellPhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="cellPhone"><br>
  	  <label for= "FSO">Select FSO of the User: </label>
        <select name = "FSO">
		<option disabled selected>--Select--</option>
        <option value="1">Family Support Organization of Union County </option>
        <option value="2">Family Support Organization of Passaic County </option>
        <option value="3">Ocean County Family Support Organization, Inc </option>
        <option value="4">Family Partners of Morris & Sussex Counties </option>
    	  <option value="5">Family Based Services Association of New Jersey, Inc (Monmouth County FSO)</option>
    	  <option value="6">Family Support Organization of Middlesex County </option>
    	  <option value="7">Family Support Organization of Mercer County </option>
    	  <option value="8">Family Partners of Hudson County </option>
    	  <option value="9">Family Support Organization of Hunterdon, Somerset, and Warren Counties </option>
    	  <option value="10">Family Support Organization of Essex County</option>
    	  <option value="11">Family Support Organization of Cumberland, Gloucester, and Salem Counties</option>
    	  <option value="12">Family Support Organization of Camden County</option>
    	  <option value="13">Family Support Organization of Burlington County</option>
    	  <option value="14">Family Support Organization of Bergen County</option>
    	  <option value="15">Atlantic Cape Family Support Organizations, Inc</option>
        </select>
        <br>
  	  <label for= "role">Select the Role of the User: </label>
        <select name = "role">
		<option disabled selected>--Select--</option>
        <option value="1">Employee/Staff </option>
        <option value="2">Supervisor </option>
        <option value="3">Youth Coordinator</option>
        <option value="4">Outreach Coordinator</option>
        <option value="5">Executive Director</option>
        </select>
        <br>
        <input class="button" type="submit" name="register"/>
      </form>
     </div>
  </body>
</html>
<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

if(        isset($_POST['username'])
        && isset($_POST['password'])
        ){
        $pass = $_POST['password'];
        //let's hash it
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        //echo "<br>$pass<br>";
        //it's hashed
        require("config.php");
        $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
        try {
              $db = new PDO($connection_string, $dbuser, $dbpass);
              $stmt = $db->prepare("INSERT INTO `personal_info` 
      					VALUES (:firstname, :lastname, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, :cell_phone, DEFAULT, DEFAULT)");
              $params = array(":firstname"=> $_POST['FName'], ":lastname"=> $_POST['LName'], ":cell_phone"=> $_POST['cellPhone']);
              $stmt->execute($params);
              $id = intval($db->lastInsertId());
              #echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
              
              $stmt = $db->prepare("INSERT INTO `users` 
				VALUES (:username, :password, :role, DEFAULT,:fso_id, :person_id)");
              $username = $_POST['username'];
              $params = array(":username"=> $username, ":password"=> $pass, ":role"=> $_POST["role"], ":fso_id"=> $_POST["FSO"], ":person_id"=>$id);
              $stmt->execute($params);
              #echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
        }
        catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
}
?>
