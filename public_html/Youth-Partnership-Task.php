<?php
require("config.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  ini_set('display_errors', 1);

// get staff list first
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:u_id');
$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fso_id = $data[0]['fso_id'];

$stmt = $db->prepare('SELECT person_id FROM users WHERE fso_id=:u_id');
$stmt->execute(['u_id' => $fso_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$id_list = array_column($data, 'person_id');


$select = 'SELECT firstname,lastname FROM personal_info WHERE person_id in ('.implode(',', $id_list).')';
$stmt = $db->prepare($select);
$stmt->execute();
$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST) && !empty($_POST['date_task'])){
	
	$date_task = $_POST['date_task'];
	$duration_hours = $_POST['duration_hours'];
	$duration_minutes = $_POST['duration_minutes'];
	$staff_id = $_POST['staff_id'];
	$description = $_POST['description'];
	
	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		
		$sql = "INSERT INTO `YouthPartnershipTask` (`date_of_task`, `duration_hours`, `duration_minutes`, `staff_id`, `description`)";
		$sql .= " VALUES('$date_task', '$duration_hours', '$duration_minutes', '$staff_id', '$description')";
		
		if($db->query($sql)) {
			$success = "Success";
		} else {
			$error = "Error";
		}
		
    }
     catch(Exception $e){
          echo $e->getMessage();
             exit();
     }
	}
 ?>

<html lang="en" dir="ltr">
<style media="screen">
  red{
    color: red;
  }
</style>
<head>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

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
  <div class="col">
    <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 30px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
  <br><bh>Youth Partnership Tasks</bh><br>
  <br>
    <form name="mainForm" method="post">
      <label for="Date of Task">Date of Task:</label>
      <input type="date" name="date_task"required>
      <br>
      <label for="Task Duration">Task Duration:</label>
      <input type="number" name="duration_hours" placeholder="Hours"required>
      <input type="number" name="duration_hours" placeholder="Minutes"required><br><br>
      <label for="Staff">Staff:</label>
	    <select name="staff_id">
      <option disabled selected>--Select--</option>

		    <?php
		    foreach($data2 as $staff) {
            var_dump($staff);
			    ?>
		    <option value="<?=$staff['person_id']?>"><?php echo $staff['firstname'] . ' ' . $staff['lastname'];?></option>
		    <?php
		    } 
		    ?>
	    </select>
      <br>
      <label for="Task Discription">Description of Task:<red>*</red></label><br>
      <textarea form="mainForm" name="description" rows="5" cols="80"></textarea>
      <br>
      <br>
      <input type="submit" value="Submit">
    </form>
  </div>
  </body>
  
</html>


	
