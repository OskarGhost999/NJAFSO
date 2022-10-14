<?php

session_start();

require ("config.php");

if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

if(!($_SESSION['role']>=0)){

  header("Location: index.php");

}

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db= new PDO($connection_string, $dbuser, $dbpass);

?>

<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 30px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php
  include_once('navbar.php');
?>
<br>
<body>
  <bh>FSO Meeting and Training Attendance</bh><br><br>
    <form class="col" name="meeting" id="meeting" method="POST">
      <label for="TypeofMeeting2">Type of Meeting/Training:</label>
      <select name="TypeofMeeting2" required>
      <option disabled selected>--Select--</option>
      <option value="FSO group supervision meeting">FSO Group Supervision Meeting</option>
      <option value="CMO training/community activity">CMO training/community activity</option>
      <option value="General Strategy/Policy/Procedure meeting">JDAI</option>
      <option value="Other">Other</option>
      <option value="ETO">ETO</option>
      <option value="Intern Supervision">Intern Supervision</option>
      <option value="Intern Training">Intern Training</option>
      <option value="Staff Training">Staff Training</option>
      <br>
      <br>
      </select>
      <br>
      <label for="MeetingLocation">Meeting/Training Location</label>
      <select name="MeetingLocation" required>
      <option disabled selected>--Select--</option>
      <option value="Community">Community</option>
      <option value="Court">Court</option>
      <option value="Detention">Detention</option>
      <option value="Email/Fax">Email/Fax</option>
      <option value="FSO-Staff Meeting">FSO-Staff Meeting</option>
      <option value="Intern Supervision">Intern Supervision</option>
      <option value="Intern Training">Intern Training</option>
      <option value="Staff Training">Staff Training</option>
      <br>
      <br>
      </select>
      <br>
      <label for="NumOfAttend">Number of people in attendance:</label>

      <input type="number" name="NumOfAttend" required/>
      <br>
      <label for="notes">Notes:</label>
      <br>
      <textarea form="meeting" name="notes" rows="5" cols="80"></textarea>
      <br>
      <br>
      <input class="button" type="submit" name="submit"/>
    </form>

</body>
</html>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
	if($_POST){
		
		#var_dump($_POST);

		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
		$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:id');
		$stmt->execute(['id' => intval($_SESSION["ID"])]);
		$data1 = $stmt->fetch();

		#var_dump($data1);

		try{
			$stmt = $db->prepare("INSERT INTO `outmeet`
                        VALUES (DEFAULT,:fso_id,:meeting_type, :meeting_location,:number_people, :notes)");
			$params = array(":fso_id"=> $data1['fso_id'],":meeting_type"=> $_POST["TypeofMeeting2"], ":meeting_location"=> $_POST["MeetingLocation"],
							":number_people"=> $_POST["NumOfAttend"],":notes"=> $_POST["notes"]);
			
			$stmt->execute($params);
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}



 ?>
