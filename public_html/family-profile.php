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
<title>Profile</title>
</head>

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
	if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

	if(!($_SESSION['role']>=0)){

	header("Location: index.php");

}

    if(isset($_GET["fid"])){
        $family_id = $_GET["fid"];
    } else {
        echo "fid is not set...";
		exit();
    }

echo "family id is: $family_id<br>";

// separate the function calls if the query return status is needed

$info = Common::get(DBL::get_family_info($family_id), "data");

echo "<br>Info:<br>";
var_export($info);

$address = Common::get(DBL::get_address($family_id), "data");

echo "<br><br>Address:<br>";
var_export($address);

$case = Common::get(DBL::get_case($family_id), "data");

echo "<br><br>Case:<br>";
var_export($case);

// returns most recent results first
$progress_notes = Common::get(DBL::get_progress_notes($family_id), "data");

echo "<br><br>Progress Notes:<br>";
if (!empty($progress_notes)) {
  var_export($progress_notes);
} else {
  echo "No progress notes yet!<br>";
}

// ordered by submission date
$fans = Common::get(DBL::get_fans($family_id), "data");

echo "<br><br>Most Recent FANS Assessment:<br>";
if (!empty($fans)) {
    var_export($fans);
} else {
    echo "{$info["firstname"]} {$info["lastname"]} has not yet completed a FANS Assessment.";
}


// no db table for this yet
echo "<br><br>Programs:<br>";
echo "Family Support";

$progress_files = Common::get(DBL::get_progress_files($family_id), "data");
$fans_files = Common::get(DBL::get_fans_files($family_id), "data");

// TODO: check and loop
echo "<br><br>Documents:<br>"; ?>
<html> <a href=<?php echo "/" . $progress_files[0]['path']; ?> download=<?php echo $progress_files[0]['original_name'];?>><?php echo $progress_files[0]['original_name'];?></a> </html>
<br>
<html> <a href=<?php echo "/" . $fans_files[0]['path']; ?> download=<?php echo $fans_files[0]['original_name'];?>><?php echo $fans_files[0]['original_name'];?></a> </html>



