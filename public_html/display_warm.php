  <?php
      include_once('navbar.php');
  ?>
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
<html>
	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</head>

  <br>
  <bh>Warmlines Records</bh><br>
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

	if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
	}
	   error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	   ini_set('display_errors', 1);
	   require "config.php";
       $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
       $db= new PDO($connection_string, $dbuser, $dbpass);
	   echo "<br>";
	   echo "<div class='col'>";
	   echo "<table border='1'>";
       try{
		   $q = $db->prepare("DESCRIBE warmline");
		   $q->execute();
		   $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
		   foreach ($table_fields as $col_name) {
			   $col_name = ucwords(str_replace("_"," ",$col_name));
			   echo "<td>" .$col_name."</td>";
			   }
			   $stmt = $db->prepare('SELECT * FROM warmline WHERE uid=:u_id');
			   $stmt->execute(['u_id' => intval($_SESSION["ID"])]);
			   $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			   foreach ($data as $row) {
				   echo "<tr>";
				   foreach ($row as $value){
						 echo "<td>" . $value . "</td>";
						 }
						 echo "</tr>";
					}
				}
		catch(Exception $e){
			echo $e->getMessage();
			exit();
		}
    ?>
