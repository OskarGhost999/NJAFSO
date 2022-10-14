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

	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <br>


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
    #include ("personalinfo.php");
    #include ("display_fans.php");


	if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

	if(!($_SESSION['role']>=0)){

	header("Location: index.php");

}



	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

	$db= new PDO($connection_string, $dbuser, $dbpass);

	#$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);

$q = $db->prepare("DESCRIBE personal_info");
$q->execute();
$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

echo "<br>";
echo "<div class='col'>";
echo "<table id='personalInfo' border='1'>";
echo "<tr>";

foreach ($table_fields as $col_name) {
    $col_name = ucwords(str_replace("_"," ",$col_name));
    echo "<th>" .$col_name."</th>";
}
echo "<th>Address 1</th><th>ZIP</th>";
echo "</tr>";

$stmt = $db->prepare('SELECT person_id FROM family WHERE fid=:u_id');
$stmt->execute(['u_id' => $_GET["fid"]]);
$data = $stmt->fetchAll();

$pid =  $data[0][0]["personal_id"];

$stmt = $db->prepare('SELECT fid, address_id FROM family WHERE person_id=:pid');
$stmt->execute(['pid' => $pid]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fan_id = $data[0]["fid"];
$a_id = $data[0]["address_id"];

$stmt = $db->prepare('SELECT * FROM personal_info WHERE person_id=:pid');
$stmt->execute(['pid' => $pid]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<tr>";

foreach ($data[0] as $value){    
    echo "<td>" . $value . "</td>";
}



$stmt = $db->prepare('SELECT address1, zip FROM address WHERE address_id=:add_id');
$stmt->execute(['add_id' => $a_id]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);



foreach($data[0] as $value){
    echo "<td>" . $value . "</td>";
}
echo "</tr>"; 
echo "</table></div><br>";

echo "<div class='col'>";
echo "<table id='fans_info' border='1'>";
echo "<tr>";

$q = $db->prepare("DESCRIBE fans");
$q->execute();
$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
array_pop($table_fields);
array_pop($table_fields);
array_pop($table_fields);

$lists = array_chunk($table_fields, 8);

$stmt = $db->prepare('SELECT * FROM fans WHERE f_id=:fan_id');
$stmt->execute(['fan_id' => $fan_id]);
$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($data2 as $row){

    array_pop($row);
    array_pop($row);
	unset($row['fan_file_id']);
    $r = array_chunk($row, 8);

    if(count($r) === count($lists)){
        foreach(range(0, count($r) - 1) as $n){
            echo"<tr>";
            foreach(range(0, count($lists[$n]) -1) as $elm) {
                $col_name = ucwords(str_replace("_"," ",$lists[$n][$elm]));
                echo("<td>" . $col_name . "</td>");
            }
            echo("</tr><tr>");
            foreach(range(0, count($r[$n]) -1) as $elm) {
                echo("<td>" . $r[$n][$elm] . "</td>");
            }
            echo("</tr>");
        }
    }
}

echo "</table></div>";
echo "<br>";


?>