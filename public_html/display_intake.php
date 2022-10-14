<?php
      include_once('navbar.php');
  ?>

<html>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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
  </body>

	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
</div>
</body>
</html>
<split>
<br><bh>Family Records</bh>
<br>
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
		   
		   
		    $q = $db->prepare("DESCRIBE personal_info");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			array_pop($table_fields);
			#unset($table_fields['address_id']);
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td>" .$col_name."</td>";
				}
				
			$q = $db->prepare("DESCRIBE address");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			array_pop($table_fields);
			array_pop($table_fields);
			#unset($table_fields['address_id']);
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td>" .$col_name."</td>";
				}

			$q = $db->prepare("DESCRIBE family");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			array_pop($table_fields);
			array_pop($table_fields);
			#array_pop($table_fields);
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td>" .$col_name."</td>";
				}

				echo "<td> Case Number </td>";
				echo "<td> Program start date </td>";
				echo "<td> Care manager </td>";
				echo "<td> DYFScontact </td>";

			$stmt = $db->prepare('SELECT * FROM family WHERE uid=:u_id');

			$stmt->execute(['u_id' => intval($_SESSION["ID"])]);

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			#var_dump($data);
			
			$counter = 0;
			foreach ($data as $row) {
				$stmt = $db->prepare('SELECT * FROM personal_info WHERE person_id=:pers_id');
				$stmt->execute(['pers_id' => $row['person_id']]);
				$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				unset($data2[0]['person_id']);
				echo "<tr>";
				foreach ($data2[0] as $value){
						 echo "<td>" . $value . "</td>";
				  }
				  
				$stmt = $db->prepare('SELECT * FROM address WHERE address_id=:address_id');
				$stmt->execute(['address_id' => $row['address_id']]);
				$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				unset($data2[0]['address_id']);
				unset($data2[0]['county']);
				foreach ($data2[0] as $value){
						 echo "<td>" . $value . "</td>";
				  } 
				unset($row['address_id']);
				unset($row['person_id']);
				#var_dump($row);
				foreach ($row as $value){
						 echo "<td>" . $value . "</td>";
				  }

				$stmt1 = $db->prepare('SELECT casenumber,programstartdate,caremanager,dyfscontact FROM cases where fid = ?');
				$stmt1->execute([$row['fid']]);
				$data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				foreach ($data as $row1){
					foreach ($row1 as $value1)
					echo "<td>" . $value1 . "</td>";
					}
				echo "</tr>";
				$counter++;
			   }
		    }
		catch(Exception $e){
			echo $e->getMessage();
			exit();
		}
    ?>
