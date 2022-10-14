<html>

	<header>
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	</header>
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
    body{
      background-color: white;
    }
    table{
			border-color:#004060;
			border-width: 3px;
		}
		th, td{
			padding: 8px;
			border-width: 2px;
		}
  </style>
<body>
  <br>
  <bh>Satisfaction Survey Feedback</bh><br>
</body>

	
</html>

<?php
	require("config.php");
	session_start();

	if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
}

	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
	$db= new PDO($connection_string, $dbuser, $dbpass);

	echo "<br>";
	echo "<div class='col'>";
	echo "<table border='1'>";
	echo "<td> ID </td>";
	echo "<td> First Name </td>";
	echo "<td> Last Name </td>";

	echo "<td> The FSO staff provided services promptly and efficiently </td>";
	echo "<td> The FSO staff was curteous and professional </td>";
	echo "<td> The FSO staff was informed or made an effort to get the information needed to assist me </td>";
	echo "<td> The FSO staff was knowledgable and able to answer my questions </td>";
	echo "<td> The FSO staff model self-advocacy skills for me </td>";
	echo "<td> The services that I received helped me to make progress towards my family's goals </td>";
	echo "<td> The quality of life in our home has improved as a result of the services provided by the FSO </td>";
	echo "<td> I would recommend the FSO services to other families </td>";

		try{
			
			$stmt = $db->prepare('SELECT fid,person_id FROM family WHERE uid=:u_id');

			$stmt->execute(['u_id' => intval($_SESSION["ID"])]);

			$data = $stmt->fetchAll();

			

			foreach ($data as $family_id){
				
				$stmt = $db->prepare('SELECT * FROM survey WHERE f_id=:fam_id');
				$stmt->execute(['fam_id' => $family_id[0]]);
				$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
				$stmt = $db->prepare('SELECT firstname,lastname FROM personal_info WHERE person_id=:pers_id');
				$stmt->execute(['pers_id' => $family_id['person_id']]);
				$data3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

				#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
				foreach ($data2 as $row){
					echo "<tr>";
					echo "<td>" . $data[0]["fid"] . "</td>";
					echo "<td>" . $data3[0]["firstname"] . "</td>";
					echo "<td>" . $data3[0]["lastname"] . "</td>";

					echo "<td>" . $row["prompt"] . "</td>";
					echo "<td>" . $row["court"] . "</td>";
					echo "<td>" . $row["inform"] . "</td>";
					echo "<td>" . $row["knowledge"] . "</td>";
					echo "<td>" . $row["advocacy"] . "</td>";
					echo "<td>" . $row["goals"] . "</td>";
					echo "<td>" . $row["qol"] . "</td>";
					echo "<td>" . $row["recommend"] . "</td>";
				}
		}

	}
	

	catch(Exception $e){
			echo $e->getMessage();
			exit();
		}

?>
  
