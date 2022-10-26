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


 ?>

<!DOCTYPE html>
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
  </style>
  <head>
    <title>Meetings attended by FSO</title>
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
  <!-- <bh>Assigned FSO Meeting Form</bh><br><br> -->
	<body>
		<div class = "card cCenter">
			<div class="col">
            	<bh><h1>Assigned FSO Meeting Form</h1></bh><br><br>
				<form class ="form1" name="Intake" id="Intake" method="POST">
					<label for="MeetingPersons">Who attended the meeting?:</label>
					<select name="MeetingPersons" required>
					<option disabled selected>--Select--</option>

						<option value="FSO Exceutive Director">FSO Exceutive Director</option>
						<option value="FSP Director">FSP Director</option>
						<option value="Outreach Coordinator">Outreach Coordinator</option>
						<option value="Youth Coach">Youth Coach</option>
					</select>
					<br>
					<label for="TypeofMeeting">Type of Meeting:</label>
					<select name="TypeofMeeting" required>
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
					</select>
					<br>
					<label for= "ContactLocation">Contact Location: </label>
					<select name = "ContactLocation" required>
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
					</select>
					<br>
					<label for="TimeSpent">Time Spent:</label>
					<input type="number" name="TimeSpent" required/><br>
					<br>
					<label for="Notes2">Notes:</label><br>
					<textarea form="Intake" name="Notes2" rows="8" cols="40"></textarea>
					<br>
					<input class="button" type="submit" name="submit"/>
				</form>
			</div>
		</div>
	</body>
</html>


<?php
	if($_POST){

		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
		$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:id');
		$stmt->execute(['id' => intval($_SESSION["ID"])]);
		$data1 = $stmt->fetch();

		#var_dump($data1);

		try{
			$stmt = $db->prepare("INSERT INTO `fso_meeting`
                        VALUES (:meeting_person, :meeting_type,:contact_location,:time_spent,:meeting_notes,DEFAULT,:fso_id)");
			$params = array(":meeting_person"=> $_POST["MeetingPersons"],":meeting_type"=> $_POST["TypeofMeeting"], ":contact_location"=> $_POST["ContactLocation"],
							":time_spent"=> $_POST["TimeSpent"],":meeting_notes"=> $_POST["Notes2"], ":fso_id"=> $data1['fso_id']);

			$stmt->execute($params);
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}



 ?>
