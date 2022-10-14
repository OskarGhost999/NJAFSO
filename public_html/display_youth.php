<html>
	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</head>
 <?php include_once('navbar.php'); ?>
	<style>
		table{
			border-color:#004060;
			border-width: 3px;
		}
		th, td{
			padding: 8px;
			border-width: 2px;
		}
   bh{
    font-weight: regular;
    margin-right: 10px;
    font-size: 40px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 
    body{
      background-color:white;
    }
	</style>
 <body>
   <br><bh>Youth</bh>
 </body>
</html>

      
<?php
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
	
	echo "<br>";
	echo "<div class='col'>";
	   echo "<table border='1'>";
       try{
			echo "<td>ID</td>";
			
			$q = $db->prepare("DESCRIBE personal_info");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			array_pop($table_fields);
			unset($table_fields[4]);
			unset($table_fields[6]);
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td>" .$col_name."</td>";
			}
			echo "<td>Address</td>";
			
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td> Parent's " .$col_name."</td>";
			}

			echo "<td>Parent's Address</td>";
			
			echo "<td>Emergency's Contact 1 Name</td>";
			echo "<td>Emergency's Contact 1 Phone</td>";
			echo "<td>Emergency's Contact 1 Relationship</td>";
			
			echo "<td>Emergency's Contact 2 Name</td>";
			echo "<td>Emergency's Contact 2 Phone</td>";
			echo "<td>Emergency's Contact 2 Relationship</td>";
				
			$q = $db->prepare("DESCRIBE youth_intake");
			$q->execute();
			$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
			array_pop($table_fields);
			array_pop($table_fields);
			array_pop($table_fields);
			array_pop($table_fields);
			array_pop($table_fields);
			array_pop($table_fields);
			array_pop($table_fields);
			foreach ($table_fields as $col_name) {
				$col_name = ucwords(str_replace("_"," ",$col_name));
				echo "<td>" .$col_name."</td>";
				if ($col_name === 'School Name'){
					echo "<td>School's Address</td>";
				}
			}
			
			
				
			$stmt = $db->prepare('SELECT * FROM youth_intake WHERE u_id=:u_id');
			$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($data as $row) {
				echo "<tr>";
				echo "<td>" .$row['youth_id']."</td>";
				$stmt = $db->prepare('SELECT * FROM personal_info WHERE person_id=:youth_id');
				$stmt->execute(['youth_id' => $row['youth_person']]);
				#$stmt->nextRowset();
				$youth_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT * FROM address WHERE address_id=:youth_address');
				$stmt->execute(['youth_address' => $row['youth_address']]);
				$youth_addr = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT * FROM personal_info WHERE person_id=:parent_id');
				$stmt->execute(['parent_id' => $row['parent_person']]);
				$parent_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT * FROM address WHERE address_id=:parent_address');
				$stmt->execute(['parent_address' => $row['parent_address']]);
				$parent_addr = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT * FROM address WHERE address_id=:school_address');
				$stmt->execute(['school_address' => $row['school_address']]);
				$school_addr = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT name,phone,relationship FROM emergency_contact WHERE youth_id=:youth_id');
				$stmt->execute(['youth_id' => $row['youth_id']]);
				$emer_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				#var_dump($row);
				unset($youth_data[0]['gender']); unset($youth_data[0]['race']); unset($parent_data[0]['gender']); unset($parent_data[0]['race']);
				array_pop($youth_data[0]); array_pop($parent_data[0]);
				foreach ($youth_data[0] as $value){
					#var_dump($value);
					echo "<td>" .$value."</td>";
				}
				
				$youth_display_addr = $youth_addr[0]['address1'] . ", " . $youth_addr[0]['zip'] . ", " . $youth_addr[0]['county'];
				echo "<td>" .$youth_display_addr."</td>";
				
				foreach ($parent_data[0] as $value){
					#var_dump($value);
					echo "<td>" .$value."</td>";
				}
				
				
				
				$parent_display_addr = $parent_addr[0]['address1'] . ", " . $parent_addr[0]['zip'] . ", " . $parent_addr[0]['county'];
				echo "<td>" .$parent_display_addr."</td>";
				
				$school_display_addr = $school_addr[0]['address1'] . ", " . $school_addr[0]['zip'] . ", " . $school_addr[0]['county'];
				
				foreach ($emer_data as $em_row){
					foreach ($em_row as $value){
					#var_dump($value);
						echo "<td>" .$value."</td>";
					}
				}
				
				array_pop($row);
				array_pop($row);
				array_pop($row);
				array_pop($row);
				array_pop($row);
				array_pop($row);
				array_pop($row);
				$counter = 0;
				foreach ($row as $value){
					#var_dump($value);
					if ($counter === 4){
						echo "<td>" .$school_display_addr."</td>";
				}
					echo "<td>" .$value."</td>";
					$counter++;
				}
				
			}
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
	   }
	   
	   catch(Exception $e){
			echo $e->getMessage();
			exit();
		}
?>