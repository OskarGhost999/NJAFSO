<?php
	include_once('navbar.php');
	require("config.php");
	if(!(isset($_SESSION['role']))){
		header("Location: index.php");
	}
	if(!($_SESSION['role']>=0)){
		header("Location: index.php");
	}

	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$db= new PDO($connection_string, $dbuser, $dbpass);

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 1);
	
	$stmt = $db->prepare('SELECT fid, uid,person_id FROM family WHERE uid=:id');
	$stmt->execute(['id' => intval($_SESSION["ID"])]);
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="en" dir="ltr">
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
    body{
      background-color: #e0f5f5;
    }
  </style>
  
  <head>
    <meta charset="utf-8">
    <title>Progress Notes</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #e0f5f5;">

    <div class="lead text-center">
        <h1 class="display-4">Family Progress Notes</h1>
    </div>

    <div class="col">
	<div class = "container">
	<div class = "card" style="background-color: #7dcbd4; border-radius:25px">
      <div class = "card-body">

    <div class="col">
      <form name="mainForm" id= "mainForm" method="post" enctype="multipart/form-data">
	  	<label>Select the Family:</label>
	  <br>
      <select name="family" required>
        <option value=""  disabled selected>--Select--</option>
		<?php foreach ($data as $row) {
			$stmt = $db->prepare('SELECT firstname, lastname FROM personal_info WHERE person_id=:id');
			$stmt->execute(['id' => $row['person_id']]);
			$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
			#var_dump($data2);

			?>
		<option value= <?php echo $row["fid"]; ?> > <?php echo $data2[0]["firstname"]; echo " "; echo $data2[0]["lastname"]; echo " "; echo $row["fid"];}?> </option>
      </select><br><br>
        <label for="noteTime">Note Time:</label>
        <input type="datetime-local"  name="noteTime" required />
        <br>
        <label for="duration">Duration in Minutes:</label>
        <input type="number" name="duration" />
        <br>
        <label for="noteType">Note Type:</label>
        <select name="noteType" required>
          <option disabled selected>--Select--</option>
          <option value="FSO:Child/FamilyParticipation">FSO:Child/Family Participation</option>
          <option value="FSO:CollateralContacts">FSO:Collateral Contacts</option>
          <option value="FSO:ContactFamily">FSO:Contact with Family</option>
          <option value="FSO:FsoTeamMeeting">FSO:FSO Team Meeting</option>
          <option value="FSO:InitialFacetoFaceVisit">FSO:Initial Face to Face Visit </option>
          <option value="FSO:OngoingFacetoFace">FSO:Ongoing Face to Face </option>
          <option value="FSO:Transition">FSO:Transition </option>
          <option value="Telehealth:Audio">Telehealth:Audio Only </option>
          <option value="Telehealth:Audiovisual">Telehealth:Audiovisual </option>
        </select>
        <br>
        <label for="Note">Progress Note:</label>
        <br>
        <textarea form="mainForm" name="APFamilyComm" rows="5" cols="80"></textarea>
        <br><br>
        <label for="contactLocation">Contact Location:</label>
        <select name="contactLocation"required>
          <option disabled selected>--Select--</option>
          <option value="Program Site">At Program Stie</option>
          <option value="Church">Church</option>
          <option value="Court">Court</option>
          <option value="Familys Residence">Family's Residence</option>
          <option value="Hospital">Hospital</option>
          <option value="Meet and Greet">Meet and Greet</option>
          <option value="Meeting">Meeting</option>
          <option value="Other Location in the Community">Other Location in the Community</option>
          <option value="Partner Agency">Partner Agency</option>
          <option value="School">School</option>
        </select><br>
        <label for="EncourageAdvocacy">Encourage Advocacy/Legacy:</label>
        <select name="EncourageAdvocacy"required>
          <option disabled selected>--Select--</option>
          <option value="Not Evaluated">Not Evaluated</option>
          <option value="I never speak up at CFT/IEP meetings">I never speak up at CFT/IEP meetings</option>
          <option value="I rarely speak up at CFT/IEP meetings">I rarely speak up at CFT/IEP meetings</option>
          <option value="I sometimes speak up at CFT/IEP meetings">I sometimes speak up at CFT/IEP meetings</option>
          <option value="I ofen speak up at CFT/IEP meetings">I ofen speak up at CFT/IEP meetings</option>
          <option value="I always speak at CFT/IEP meetings">I always speak up at CFT/IEP meetings</option>
          <option value="I am proactive in resolving issues">I am proactive in resolving issues</option>
          <option value="I am a strong advocate for my child and family">I am a strong advocate for my child and family</option>
          <option value="I work to empower other other families">I work to empower other families</option>
          <option value="I work to have an impact on the system of care">I work to have an impact on the system of care</option>
        </select>
        <br>
        <label for="supportlevel">Support Level</label>
        <select name="supportlevel"required>
          <option disabled selected>--Select--</option>
          <option value="New Family">New Family</option>
          <option value="Not Engaged">Not Engaged</option>
          <option value="Intensive">Intensive</option>
          <option value="Moderate">Moderate</option>
          <option value="Supportive">Supportive</option>
          <option value="Transitioned">Transitioned</option>
          <option value="Engaged">Engaged</option>
          <option value="Engaged at First Face to Face">Engaged at First Face to Face</option>
        </select>
        <br>
        <label for="startingLocation">Starting Location:</label>
        <input type="text" name="startingLocation"/>
        <br>
        <label for="endingLocation">Ending Location:</label>
        <input type="text" name="endingLocation"/>
        <br>
        <label for="mileage">Mileage:</label>
        <input type="number" name="mileage"required/>
        <br>
        <label for="TravelTime">Travel Time(Minutes):</label>
        <input type="number" name="TravelTime"/>
        <br>
        <label for="RecordKeepingTime">Record Keeping Time(Minutes):</label>
        <input type="number" name="RecordKeepingTime"/>
        <br>
        <label for="service">Service:</label>
        <select name="service"required>
          <option disabled selected>--Select--</option>
          <option value="weekly">Weekly</option>
          <option value="Bi-weekly">Bi-Weekly</option>
          <option value="Monthly">Monthly</option>
        </select>
        <br>
        <input type="file" id="myFile" name="filename"/><br><br>
        <input type="submit" class = "btn btn-secondary">
      </form>
    </div>
    </div>
    </div>
    </div>
  </body>
</html>

<?php

#var_dump($_POST);
	
	if($_POST){
		$q = $db->prepare("DESCRIBE progress_note");
		$q->execute();
		$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

		$wat = $_POST['family'];
		unset($_POST['family']);
		array_pop($table_fields);
		$table_fields[13] = 'fid';
		
		$sql = 'INSERT INTO progress_note VALUES ( %s, DEFAULT)';

		$valuesClause = implode( ', ', array_map( function( $value ) { return ':' . $value; }, $table_fields ) );

		$sql = sprintf( $sql, $valuesClause );
		
		$counter = 0;
		$params = [];
		foreach ($_POST as $place => $other){
			$temp = ":";
			$temp .= $table_fields[$counter];
			$params[$temp] = $other;
			#echo $temp;
			$counter++;
		}
		
		$temp = ':';
		$temp .= "fid";
		$params[$temp] = $wat;
		if(!empty($_FILES["filename"]["name"])){
			$filename = $_FILES['filename']['name'];
			$temp = explode(".", $_FILES["filename"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$destination = 'uploads/' . $filename;
			$file = $_FILES['filename']['tmp_name'];

			if ($_FILES['filename']['size'] > 500000) { // file shouldn't be larger than 500KB
				echo "File too large!";
			}

			elseif (move_uploaded_file($file, $destination . $newfilename)) {
				#echo ($destination . $newfilename);
				$stmt1 = $db->prepare("INSERT INTO `file_info` VALUES (?,?,?,DEFAULT)");
				$stmt1->execute([$filename, $newfilename, $destination . $newfilename]);
				#echo "<pre>" . var_export($stmt1->errorInfo(), true) . "</pre>";
				$params[':file_id'] = intval($db->lastInsertId());
			}
		}

		else{
			$params[':file_id'] = NULL;
		}
		
		#var_dump($sql);
		
		try{

			$stmt = $db->prepare($sql);

			$stmt->execute($params);

			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
				echo $e->getMessage();
				exit();
		}

	
	}

?>
