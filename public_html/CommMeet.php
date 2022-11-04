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
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<style>
		bh{
		font-weight: normal;
		margin-right: 10px;
		font-size: 30px;
		padding: 10px;
		font-family: 'Poppins', sans-serif;
		}
		.cCenter {
			margin: auto;
			width: 75%;
			padding: 10px;
		}
		.fCenter {
			margin: auto;
			padding: 10px;
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

	<body>
		<br>
		<!-- <h1>Community Initiatives and Meetings Provided by FSO</h1> -->
		<br>
		<div class = "card cCenter" >
			<bh><h1>Community Initiatives and Meetings Provided by FSO</h1></bh>
			<form class="col fCenter" name="CommMeet" id="CommMeet" method="POST">
				<label for="MeetingPersons">Who attended the meeting?:</label>
				<br>
				<select name="MeetingPersons">
					<option disabled selected>--Select--</option>
					<option value="FSO Exceutive Director">FSO Exceutive Director</option>
					<option value="FSP Director">FSP Director</option>
					<option value="Outreach Coordinator">Outreach Coordinator</option>
					<option value="Youth Coach">Youth Coach</option>
					<br>
					<br>
				</select>
				<br>
				<br>
				<label for="TypeofMeeting">Type of Meeting:</label>
				<br>
				<select name="TypeofMeeting">
					<option disabled selected>--Select--</option>
					<option value="CIACC">CIACC</option>
					<option value="Youth Services">Youth Services</option>
					<option value="JDAI">JDAI</option>
					<option value="Other">Other</option>
					<option value="Youth Fire Setters">Youth Fire Setters</option>
					<option value="Reentry Task Force">Reentry Task Force</option>
					<option value="IDD">IDD</option>
					<option value="NJAFSO Committee Meetings">NJAFSO Committee Meetings</option>
					<option value="Education Partnership">Education Partnership</option>
					<option value="IMPACT">IMPACT</option>
					<option value="CYCC- County Council for Young Children">CYCC- County Council for Young Children</option>
					<option value="FSO Executive Director Meeting">FSO Executive Director Meeting</option>
					<option value="CSOC Statewide Meeting">CSOC Statewide Meeting</option>
					<br>
					<br>
				</select>
				<br>
				<br>
				<label for= "ContactLocation">Contact Location: </label>
				<br>
				<select name = "ContactLocation">
					<option disabled selected>--Select--</option>
					<option value="At a meeting">At a meeting</option>
					<option value="At program site">At program site</option>
					<option value="In the Community">In the Community</option>
					<option value="Courthouse">Courthouse</option>
					<option value="Detention">Detention</option>
					<option value="Email/Fax">Email/Fax</option>
					<option value="FSO-Staff Meeting">FSO-Staff Meeting</option>
					<option value="Off-site">Off-site</option>
					<option value="Office">Office</option>
					<option value="On the phone">On the phone</option>
					<option value="Other">Other</option>
					<option value="Probation Office">Probation Office</option>
					<option value="Research">Research</option>
					<option value="School">School</option>
					<option value="Tr-Training">Tr-Training</option>
					<option value="CIACC">CIACC</option>
					<option value="Hospital">Hospital</option>
					<option value="Virutal">Virtual</option>
					<br>
					<br>
				</select>
				<br>
				<br>
				<label for="numppl">Number of Attendees:</label>
				<br>
				<input type="number" name="numppl"/>
				<br>
				<br>
				<label for="TimeSpent">Time Spent:</label>
				<br>
				<input type="number" name="TimeSpent"/>
				<br>
				<br>
				<label for="Notes2">Notes:</label>
				<br>
				<textarea form="text" name="Notes2" rows="5" cols="40"></textarea>
				<br>
				<br>
				<input type="submit" value="Submit">
			</form>
		</div>
	</body>
</html>

<?php
	if($_POST){

		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
		$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:id');
		$stmt->execute(['id' => intval($_SESSION["ID"])]);
		$data1 = $stmt->fetch();

		#var_dump($_POST);

		try{
			$stmt = $db->prepare("INSERT INTO `comm_meet`
                        VALUES (DEFAULT,:fso_id, :date, :meeting_person, :meeting_type,:contact_location,:number_people,:time_spent,:meeting_notes, DEFAULT, DEFAULT)");
			$params = array(
				":fso_id"=> $data1['fso_id'],
				":date" => $_POST["date"],
				":meeting_person"=> $_POST["MeetingPersons"],
				":meeting_type"=> $_POST["TypeofMeeting"],
				":number_people"=> $_POST["numppl"], 
				":contact_location"=> $_POST["ContactLocation"],
				":time_spent"=> $_POST["TimeSpent"],
				":meeting_notes"=> $_POST["Notes2"]
        );
			
			$stmt->execute($params);
			echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}



 ?>
