<?php
function table1(){
	echo "<br> <bh> Community Meetings</bh>";
	echo "<div class='col'>";
	echo "<table border='1'>";
	echo "<td> Meeting ID </td>";
	echo "<td> FSO </td>";
	echo "<td> Who attended the meeting </td>";
	echo "<td> Type of Meeting </td>";
	echo "<td> Meeting Location </td>";
	echo "<td> Number of people in attendance </td>";
	echo "<td> Time Spent </td>";
	echo "<td> Notes </td>";

	$stmt = $db->prepare('SELECT fso_id FROM users WHERE id=:uid');
	$stmt->execute(['uid' => intval($_SESSION["ID"])]);
	$data2 = $stmt->fetchAll();
	$stmt = $db->prepare('SELECT name, fso_id FROM FSO WHERE fso_id=:id');
	$stmt->execute(['id' => intval($data2[0]["fso_id"])]);
	$data2 = $stmt->fetchAll();
	try{
		$stmt = $db->prepare('SELECT * FROM comm_meet where fso_id=:fs_id');
		$stmt->execute(['fs_id' => intval($data2[0]["fso_id"])]);
		$data = $stmt->fetchAll();
		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		#var_dump($data);
		#
		#'id' => intval($_SESSION["ID"])]
		foreach ($data as $row){
			echo "<tr>";
			echo "<td>" . $row["meet_id"] . "</td>";
			echo "<td>" . $data2[0]["name"] . "</td>";		
			echo "<td>" . $row["meeting_person"] . "</td>";
			echo "<td>" . $row["meeting_type"] . "</td>";
			echo "<td>" . $row["contact_location"] . "</td>";
			echo "<td>" . $row["number_people"] . "</td>";
			echo "<td>" . $row["time_spent"] . "</td>";
			echo "<td>" . $row["meeting_notes"] . "</td>";
		}

	}



	catch(Exception $e){

			echo $e->getMessage();

			exit();

		}
}

?>