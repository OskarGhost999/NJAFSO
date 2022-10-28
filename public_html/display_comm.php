<?php

      include_once('navbar.php');

  ?>
<br>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: regular;
    margin-right: 10px;
    font-size: 40px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
<html lang="en" dir="ltr">

  <bh>Community Meetings </bh><br>
	<head>


		<title>display_outmeet</title>



		<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">







		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">







		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>







		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>







		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>







	</head>
	<style>
		table{
			border-color:#004060;
			border-width: 3px;
		}
		th, td{
			padding: 8px;
			border-width: 2px;
		}
	</style>



</html>





<?php

	require("config.php");

	session_start();



	if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

	if(!($_SESSION['role']>=0)){

	header("Location: index.php");

}



	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	$db= new PDO($connection_string, $dbuser, $dbpass);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);





	echo "<br>";

	echo "<div class='col'>";

	echo "<table border='1'>";

	echo "<td> Meeting ID </td>";

	echo "<td> Date </td>";

	echo "<td> FSO </td>";
	
	echo "<td> Who attended the meeting </td>";

	echo "<td> Type of Meeting </td>";

	echo "<td> Meeting Location </td>";

	echo "<td> Number of people in attendance </td>";
	
	echo "<td> Time Spent </td>";

	echo "<td> Notes </td>";



	$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:uid');

	$stmt->execute(['uid' => intval($_SESSION["ID"])]);

	$data2 = $stmt->fetchAll();





	$stmt = $db->prepare('SELECT name, fso_id FROM FSO WHERE fso_id=:id');

	$stmt->execute(['id' => intval($data2[0]["fso_id"])]);

	$data2 = $stmt->fetchAll();



	



	try{

		$stmt = $db->prepare('SELECT * FROM comm_meet where fso_id=:fs_id');

		$stmt->execute(['fs_id' => intval($data2[0]["fso_id"])]);

		$data = $stmt->fetchAll();

		

		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";



		#var_dump($data);



		#

		#'id' => intval($_SESSION["ID"])]

		foreach ($data as $row){

			echo "<tr>";

			echo "<td>" . $row["meet_id"] . "</td>";

			echo "<td>" . $row["date"] . "</td>";

			echo "<td>" . $data2[0]["name"] . "</td>";
			
			echo "<td>" . $row["meeting_person"] . "</td>";

			echo "<td>" . $row["meeting_type"] . "</td>";

			echo "<td>" . $row["contact_location"] . "</td>";

			echo "<td>" . $row["number_people"] . "</td>";
			
			echo "<td>" . $row["time_spent"] . "</td>";

			echo "<td>" . $row["meeting_notes"] . "</td>";

		}

	}



	catch(Exception $e){

			echo $e->getMessage();

			exit();

		}

?>

