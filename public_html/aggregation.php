<html>
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
	
</html>

<?php
	include_once('navbar.php');
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
	echo "<table id='tbl' border='1'>";
	echo "<td>Number of Families Referred from PerformCare</td>";
	echo "<td>Number of Initial Visits Completed with Care Manager</td>";
	echo "<td>Number of Initial Visits Completed Without Care Manager</td>";
	echo "<td>Number of Face to Face Meetings with Families</td>";
	echo "<td>Number of CFT's Participated In</td>";
	echo "<td>Number of FANS Completed</td>";
	echo "<td>Time Spent on All Activities Captured with Time Function in Cyber</td>";
	echo "<td>Time Spent on All Face to Face activities witn time Function in Cyber</td>";
	echo "<tr>";
	#var_dump($_SESSION);
	try{
		$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:u_id');
		$stmt->execute(['u_id' => intval($_SESSION["ID"])]);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		
		$fso_id = $data[0]['fso_id'];
		
		$stmt = $db->prepare('SELECT id FROM users WHERE fso_id=:u_id');
		$stmt->execute(['u_id' => $fso_id]);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data = array_column($data, 'id');
		
		#$in = join(',', array_fill(0, count($data), '?'));
		
		#var_dump($data);
		$select = 'SELECT COUNT(referred) FROM family WHERE uid in ('.implode(',', $data).') and referred = :ref';
		#var_dump($select);
		$stmt = $db->prepare($select);
		$stmt->execute(['ref' => 'PreformCare']);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
		
		
		$peformcare_count = $data2[0]['COUNT(referred)'];
		
		$select = 'SELECT fid FROM family WHERE uid in ('.implode(',', $data).')';
		$stmt = $db->prepare($select);
		$stmt->execute();
		$family_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$family_ids = array_column($family_ids, 'fid');
		
		
		$select = 'SELECT caremanager FROM cases WHERE fid in ('.implode(',', $family_ids).')';
		$stmt = $db->prepare($select);
		$stmt->execute();
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data2 = array_column($data2, 'caremanager');
		
		$without_care = count(array_keys($data2,"None"));
		
		$care_count = sizeof($data2) - $without_care;
		
		$select = 'SELECT duration FROM progress_note WHERE f_id in ('.implode(',', $family_ids).') and (note_type = :note or note_type = :note1)';
		$stmt = $db->prepare($select);
		$stmt->execute(['note' => 'FSO:InitialFacetoFaceVisit','note1' => 'FSO:OngoingFacetoFace']);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data2 = array_column($data2, 'duration');
		
		$facetoface = array_sum($data2);
		
		$select = 'SELECT COUNT(note_type) FROM progress_note WHERE f_id in ('.implode(',', $family_ids).') and note_type = :note';
		$stmt = $db->prepare($select);
		$stmt->execute(['note' => 'FSO:Child/FamilyParticipation']);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		#$data2 = array_column($data2, 'note_type');
		
    
		$CFT_count = $data2[0]['COUNT(note_type)'];
		
		$select = 'SELECT COUNT(f_id) FROM fans WHERE f_id in ('.implode(',', $family_ids).')';
		$stmt = $db->prepare($select);
		$stmt->execute();
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		#$data2 = array_column($data2, 'note_type');
    
		$FANS_count = $data2[0]['COUNT(f_id)'];
		
		$select = 'SELECT duration FROM progress_note WHERE f_id in ('.implode(',', $family_ids).')';
		$stmt = $db->prepare($select);
		$stmt->execute();
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data2 = array_column($data2, 'duration');
		
		$total_time = array_sum($data2);
		
		$select = 'SELECT duration FROM progress_note WHERE f_id in ('.implode(',', $family_ids).') and (note_type = :note or note_type = :note1 or note_type = :note2)';
		$stmt = $db->prepare($select);
		$stmt->execute(['note' => 'FSO:InitialFacetoFaceVisit','note1' => 'FSO:OngoingFacetoFace','note2' => 'FSO:Child/FamilyParticipation']);
		$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data2 = array_column($data2, 'duration');
		
		$F2F_duration = array_sum($data2);
		
		
		
		
		echo "<td>" . $peformcare_count . "</td>";
		echo "<td>" . $without_care . "</td>";
		echo "<td>" . $care_count . "</td>";
		echo "<td>" . $facetoface . "</td>";
		echo "<td>" . $peformcare_count . "</td>";
		echo "<td>" . $FANS_count . "</td>";
		echo "<td>" . $total_time . "</td>";
		echo "<td>" . $F2F_duration . "</td>";
		
	}
	
	catch(Exception $e){
			echo $e->getMessage();
			exit();
	   }
	
?>