<?php
require("config.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  ini_set('display_errors', 1);

// get staff list first
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
$db = new PDO($connection_string, $dbuser, $dbpass);

$stmt = $db->prepare('SELECT id, first_name, last_name FROM users WHERE fso_id=:u_id');
$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($data);
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
<body style="background-color: #e0f5f5;">
  <div class="card cCenter text-center">
    <h1 class="display-4">Youth Partnership Task</h1>
</div>
    <div class="card cCenter">

    <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 30px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
    } 
    .cCenter {
    	    margin: auto;
    	    width: 65%;
    	}
    	
		.card {
			background-color: rgb(176, 226, 255)!important;
		} 
  </style>
  <br>
  <br>
    <form name="mainForm" method="post">
      <label for="date_task">Date of Task:</label>
      <input type="date" name="date_task"required>
      <br>
      <label for="Task Duration">Task Duration:</label>
      <input type="number" name="duration_hours" placeholder="Hours"required>
      <input type="number" name="duration_minutes" placeholder="Minutes"required><br><br>
      <label for="staff_id">Staff:</label>
	    <select name="staff_id">
      <option disabled selected>--Select--</option>
		    <?php
		    foreach($data as $staff) {
            var_dump($staff);
			    ?>
		    <option value="<?=$staff['id']?>"><?php echo $staff['first_name'] . ' ' . $staff['last_name'];?></option>
		    <?php
		    } 
		    ?>
	    </select>
      <br>
      <label for="description">Description of Task:<red>*</red></label><br>
      <textarea  name="description" rows="5" cols="80"></textarea>
      <br>
      <br>
      <input type="submit" value="Submit">
    </form>
  </div>
      </div>
    </div>
  </body>
  
</html>
<?php
  if(isset($_POST) && !empty($_POST['date_task'])){
	
                $date_task = $_POST['date_task'];
                $duration_hours = $_POST['duration_hours'];
                $duration_minutes = $_POST['duration_minutes'];
                $staff_id = $_POST['staff_id'];
                $description = $_POST['description'];
              $duration_minutes = $duration_minutes/60;
              $duration = $duration_hours+$duration_minutes;
                
                try{
                    $stmts = $db->prepare("INSERT INTO `YouthPartnershipTask` VALUES(DEFAULT,:date_of_task, :duration, :staff_id, :description)");
                $params = array(
                  ":date_of_task"=>$_POST["date_task"],
                  ":duration"=>$duration,
                  ":staff_id"=>(int)$_POST["staff_id"],
                  ":description"=>$_POST["description"]);
                    $result = $stmts->execute($params);
                    if($result){
					        Common::flash("Successfully submitted", "success");
					}
					else{
						Common::flash("Submission error", "danger");
					}

					} catch(Exception $e){
							echo $e->getMessage();
							exit();
							}
  }

?>
