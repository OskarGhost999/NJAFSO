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
<html>
<head>
	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <br>



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

	include("config.php");

	if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

	if(!($_SESSION['role']>=0)){

	header("Location: index.php");

}



	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	$db= new PDO($connection_string, $dbuser, $dbpass);

	#$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);

	echo "<bh>Personal Information</bh>";

	$result = $db->query("SELECT * FROM personal_info");

	$all = $result->fetchAll();
	$col = $all[1];

	$columns = array();

	echo"<pre>";
	foreach($col AS $key=>$value)
	{
		if(is_string($key))
		{
			$columns[] = $key;
		}
	}
	echo "<table border='1'>";
	foreach($columns AS $value)
	{
		echo "<th>$value</th>";
	}

	for($x=0;$x<count($all);$x++)
	{
		echo "<tr>";
		for($y=0;$y<count($columns);$y++)
		{
			echo "<td>".$all[$x][$y]."</td>";
		}
	}
		echo "</tr>"; 

?>