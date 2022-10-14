<?php
require ("config.php");

if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

if(!($_SESSION['role']>=0)){
  header("Location: index.php");
}
if(($_SESSION['role']==1)){
  header("Location: home.php");
}

?>

<!DOCTYPE html>

<html>
<style media="screen">
  table{
    border-color:#004060;
    border-width: 3px;
    background-color: white;
  }
  th, td{
    padding: 8px;
    border-width: 2px;
  }
  .coll2{
	  padding-left: 15px;
	  width: 50%;
  }
  split{
	  width: 300px;
    float: right;
    padding-top: 30px;
    margin-right: 10px;
	  border-radius: 10px;
    border-style: solid;
	  padding-bottom: 10px;
    background-color: white;
  }
  .change{
	  border-radius: 10px;
    padding: 5px;
    padding-top: 9px;
    width: 95%;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
  }
  bh{
    font-size: 40px;
    font-family: 'Poppins', sans-serif;
  }
</style>

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Home</title>

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
<br>
<split>
	<div class="col">
	<h3><b>User Information</b><br><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12 2.5a5.5 5.5 0 00-3.096 10.047 9.005 9.005 0 00-5.9 8.18.75.75 0 001.5.045 7.5 7.5 0 0114.993 0 .75.75 0 101.499-.044 9.005 9.005 0 00-5.9-8.181A5.5 5.5 0 0012 2.5zM8 8a4 4 0 118 0 4 4 0 01-8 0z"></path></svg></h3><br>
	<h5>Username</h5>

	<?php
		$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		$db= new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare('SELECT username,fso_id FROM users WHERE id=:id');
		$stmt->execute(['id' => intval($_SESSION["ID"])]);
		$data1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo $data1[0]["username"];
	?>
	<br><br>

	<h5>FSO</h5>
	<?php
		$stmt = $db->prepare('SELECT name FROM FSO WHERE fso_id=:id');
		$stmt->execute(['id' => $data1[0]["fso_id"]]);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo $data2[0]["name"];
	?>
	<br><br>
	<button class="change" onclick="window.location.href='http://familysupportorganizationo.sg-host.com/changepassword.php';">
      <h5>Change Password</h5>
    </button>
	</div>
</split>

<split>
  <div class="col">
	<h3><b>Supervisor Tools</b><br><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M7.875 2.292a.125.125 0 00-.032.018A7.24 7.24 0 004.75 8.25a7.247 7.247 0 003.654 6.297c.57.327.982.955.941 1.682v.002l-.317 6.058a.75.75 0 11-1.498-.078l.317-6.062v-.004c.006-.09-.047-.215-.188-.296A8.747 8.747 0 013.25 8.25a8.74 8.74 0 013.732-7.169 1.547 1.547 0 011.709-.064c.484.292.809.835.809 1.46v4.714a.25.25 0 00.119.213l2.25 1.385c.08.05.182.05.262 0l2.25-1.385a.25.25 0 00.119-.213V2.478c0-.626.325-1.169.81-1.461a1.547 1.547 0 011.708.064 8.74 8.74 0 013.732 7.17 8.747 8.747 0 01-4.41 7.598c-.14.081-.193.206-.188.296v.004l.318 6.062a.75.75 0 11-1.498.078l-.317-6.058v-.002c-.041-.727.37-1.355.94-1.682A7.247 7.247 0 0019.25 8.25a7.24 7.24 0 00-3.093-5.94.125.125 0 00-.032-.018l-.01-.001c-.003 0-.014 0-.031.01-.036.022-.084.079-.084.177V7.19a1.75 1.75 0 01-.833 1.49l-2.25 1.385a1.75 1.75 0 01-1.834 0l-2.25-1.384A1.75 1.75 0 018 7.192V2.477c0-.098-.048-.155-.084-.176a.062.062 0 00-.031-.011l-.01.001z"></path></svg></h3><br>

	<button class="change" onclick="window.location.href='http://familysupportorganizationo.sg-host.com/register.php';">
      <h5>Add New User</h5>
    </button>
  <form method="POST">
    <input name="dateInput" type="month" required></input>
    <input class="change" type="submit" value = "View State Report"/>
  </form>
  <?php 
    if(isset($_POST['dateInput'])){
      $Month = $_POST[dateInput];
      $StartDate = $Month."-01 00:00:00";
      $dateArr = explode("-",$Month);
      $newMonth =  intval($dateArr[1])+1;
      if($newMonth == 13){
        $newMonth = 1;
        $dateArr[0] = intval($dateArr[0])+1;
      }
      $dateArr[1] = $newMonth;
      $EndMonth = implode("-",$dateArr);
      $EndDate = $EndMonth."-01 00:00:00";
      $_SESSION['reportdateStart'] = $StartDate;
      $_SESSION['reportdateEnd'] = $EndDate;
      echo '<script>window.location.href = "http://familysupportorganizationo.sg-host.com/aggregation.php";</script>';
    }
  ?>
	<div id="p"></div>
  </div>
</split>
<split>
	<div class="col">
	<h3><b>View My Records</b><br><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M14.53 15.59a8.25 8.25 0 111.06-1.06l5.69 5.69a.75.75 0 11-1.06 1.06l-5.69-5.69zM2.5 9.25a6.75 6.75 0 1111.74 4.547.746.746 0 00-.443.442A6.75 6.75 0 012.5 9.25z"></path></svg></h3><br>
	<h5>Select a form to display:</h5>
  
  <head>
  <style>
  h3{text-align: center;}
  p{text-align: center;}

  </style>

            <a href="display_comm.php">Community Meetings</a><br>
            <a href="display_prog.php">Family Notes</a><br>
            <a href="display_fans.php">FAN Assesment</a><br>
            <a href="display_meet.php">FSO Meeting</a><br>
            <a href="display_intake.php">Intake</a><br>
            <a href="display_satisfaction.php">Satisfaction Feedback</a><br>
            <a href="display_outmeet.php">Outreach Meeting</a><br>
            <a href="display_warm.php">Warmline Records</a><br>
            <a href="display_youth.php">Youth Records</a><br>

          </div>



</split>
<div class="coll2">

<bh>My Assigned Families</bh>
    <?php
    	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    	ini_set('display_errors', 1);
    
    	echo "<br>";
    	echo "<table border='1'>";
    	echo "<td> ID </td>";
    	echo "<td> First Name </td>";
    	echo "<td> Last Name </td>";
    	echo "<td> Case Number </td>";
    	#echo "<td> Assigned Employee </td>";
    
    	try{
    
    		$stmt = $db->prepare('SELECT fid,person_id FROM family WHERE uid=:u_id');
    
    		$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
    
    		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    
    		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    
    		foreach ($data as $family_id){
    
    			$stmt = $db->prepare('SELECT firstname,lastname FROM personal_info WHERE person_id=:pers_id');
    			$stmt->execute(['pers_id' => $family_id['person_id']]);
    			$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    			#var_dump($data2);
    			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    			foreach ($data2 as $row){
    				echo "<tr>";
    				$stmt = $db->prepare('SELECT casenumber FROM cases WHERE fid=:id');
    				$stmt->execute(['id' => intval($family_id["fid"])]);
    				$data3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    				#var_dump($data3);
    				#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    
    				echo "<td>" . $family_id['fid'] . "</td>";
    				echo "<td>" . $row["firstname"] . "</td>";
    				echo "<td>" . $row["lastname"] . "</td>";
    				echo "<td>" . $data3[0]["casenumber"] . "</td>";
    				#echo "<td>" . $data1[0]["username"] . "</td>";
    				}
    		}
    
    	}
    
    	catch(Exception $e){
    			echo $e->getMessage();
    			exit();
    		}
    
    ?>

</div>
</body>

</html>
