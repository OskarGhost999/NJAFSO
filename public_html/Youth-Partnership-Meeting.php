<?php
require("config.php");
include_once('navbar.php');
	
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:u_id');
$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fso_id = $data[0]['fso_id'];

$stmt = $db->prepare('SELECT id FROM users WHERE fso_id=:u_id');
$stmt->execute(['u_id' => $fso_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$data = array_column($data, 'id');


$select = 'SELECT youth_id,youth_person FROM youth_intake WHERE u_id in ('.implode(',', $data).')';
$stmt = $db->prepare($select);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$youth_ids = array_column($data, 'youth_id');
$youth_persons = array_column($data, 'youth_person');

$select = 'SELECT firstname,lastname FROM personal_info WHERE person_id in ('.implode(',', $youth_persons).')';
$stmt = $db->prepare($select);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$counter = 0;

#var_dump($youth_persons);

?>
<body style="background-color: #e0f5f5;">

<html lang="en" dir="ltr">
<style media="screen">
  purple{
    color: purple;
  }
</style>
<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: regular;
    margin-right: 10px;
    font-size: 30px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
  <meta charset="utf-8">
  <title>Youth Partnership Meetings</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="lead text-center">
        <h1 class="display-4">Youth Partnership Meeting</h1>
    </div>

  <div class="col">

  <div class = "container">
	<div class = "card"  style="background-color: #7dcbd4">
	<div class = "card-body">

    <br><bh>Youth Partnership Meeting</bh><br><br>
    <form name="mainForm" method="post">
      <label for="Date of Meeting">Date of Meeting:</label>
      <input type="date" name="date_meet">
      <br>
      <label for="Meeting/Event Duration">Meeting/Event Duration:</label><input type="number" name="duration_hours" placeholder="Hours">
      <input type="number" name="duration_minutes" placeholder="Minutes"><br>
      <label for="Type of Meeting">Type of Meeting:</label>
      <input type="text" name="type_meeting">
      <br>
      <b>Participants:</b><br>
	    
	  <?php
		    foreach($data as $youth) {
            #var_dump($staff);
			    ?>
			<input type="checkbox" name="participants[]" value=<?php echo "'$youth_ids[$counter]'" ?> >
			<label for=<?php echo $youth_ids[$counter]; ?>><?php echo $youth['firstname'] . ' ' . $youth['lastname']; ?></label><br>
		    <?php
			$counter++;} 
		    ?>
      <br>
      <label for="Notes">Notes:</label><br>
      <textarea form="mainForm" name="notes" rows="5" cols="80"></textarea>
	    
      <br><br>
	    <input type="hidden" name="submit_meeting" value="true"/>
      <input type="submit" value="Submit" class = "btn btn-secondary">
    </form>
  </div>
  </div>
  </div>
  </div>


  </body>
</html>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);


if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
}



#var_dump($data2);

if(isset($_POST) && !empty($_POST['submit_meeting'])){
	#var_dump($_POST);
	$date_meet = $_POST['date_meet'];
	$duration_hours = $_POST['duration_hours'];
	$duration_minutes = $_POST['duration_meetins'];
	$type_meeting = $_POST['type_meeting'];
	
	$participants = $_POST['participants'];
	$notes = $_POST['notes'];
	
	
	try{
		
		
		
	}
	
	catch(Exception $e){
			echo $e->getMessage();
			exit();
	   }
	
}
