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
  <bh>FANS Assessment Records</bh><br>
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
    #$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
    echo "<br>";
    echo "<div class='col'>";
    echo "<table id='tbl' border='1'>";
    
    try{
		echo "<tr><td>First Name</td>";
        echo "<td>Last Name</td></tr>";
        $q = $db->prepare("DESCRIBE fans");
        
        $q->execute();
        $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

        array_pop($table_fields);	
        array_pop($table_fields);
        array_pop($table_fields); // because line 105 unset($row['fan_file_id']);

        $lists = array_chunk($table_fields, 8);

        # DATA IS STORED HERE
        $stmt = $db->prepare('SELECT fid,person_id FROM family WHERE uid=:u_id');		// TAKE FROM BOTH fid & person_id
        $stmt->execute(['u_id' => intval($_SESSION["ID"])]);
        $data = $stmt->fetchAll();

        foreach ($data as $family_id){
            # HANDLE fid
            $stmt = $db->prepare('SELECT * FROM fans WHERE f_id=:fan_id');
            $stmt->execute(['fan_id' => $family_id[0]]);
            $data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt = $db->prepare('SELECT firstname,lastname FROM personal_info WHERE person_id=:pers_id');
            $stmt->execute(['pers_id' => $family_id['person_id']]);
            $data3 = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach($data2 as $row){
                echo "<tr>";
                echo "<td>" . $data3[0]['firstname'] . "</td>";
                echo "<td>" . $data3[0]['lastname'] . "</td>";
                echo"</tr>";
                array_pop($row);	// 57
                array_pop($row);	// 19
                
                $stmt = $db->prepare('SELECT * FROM file_info WHERE id=:file_id');
                $stmt->execute(['file_id' => $row['fan_file_id']]);
                $data3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                echo "<br>";
                
                if ($data3 != NULL){
                ?> <html> <a href=<?php echo "/" . $data3[0]['path']; ?> download=<?php echo $data3[0]['original_name'];?>><?php echo $data3[0]['original_name'];?></a> </html>
                <?php	}
            }  
        }
    }
			
    catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
			


			
?>
