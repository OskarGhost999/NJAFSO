<?php

session_start();

require ("config.php");

if(!(isset($_SESSION['role']))){

  header("Location: index.php");

}

if(!($_SESSION['role']>=0)){

  header("Location: index.php");

}

?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php
  include_once('navbar.php');
?>
<br>
<body>
    <form class="col" name="meeting" id="meeting" method="POST">
      <label for="TypeofMeeting/Tr">Type of Meeting/Training:</label>
      <select name="Type of Meeting2" required>
      <option value="FSO group supervision meeting">FSO Group Supervision Meeting</option>
      <option value="CMO training/community activity">CMO training/community activity</option>
      <option value="General Strategy/Policy/Procedure meeting">JDAI</option>
      <option value="Other">Other</option>
      <option value="ETO">ETO</option>
      <option value="Intern Supervision">Intern Supervision</option>
      <option value="Intern Training">Intern Training</option>
      <option value="Staff Training">Staff Training</option>
      <br>
      <br>
      </select>
      <br>
      <label for="Meeting/Training Location">Meeting/Training Location</label>
      <select name="Meeting/Training Location" required>
      <option value="Community">Community</option>
      <option value="Court">Court</option>
      <option value="Detention">Detention</option>
      <option value="Email/Fax">Email/Fax</option>
      <option value="FSO-Staff Meeting">FSO-Staff Meeting</option>
      <option value="Intern Supervision">Intern Supervision</option>
      <option value="Intern Training">Intern Training</option>
      <option value="Staff Training">Staff Training</option>
      <br>
      <br>
      </select>
      <br>
      <label for="NumOfAttend">Number of people in attendance:</label>
      <br>
      <input type="number" name="NumOfAttend" required/>
      <br>
      <label for="notes">Notes:</label>
      <br>
      <textarea form="meeting" name="notes" rows="5" cols="80"></textarea>
      <br>
      <input class="button" type="submit" name="submit"/>
    </form>

</body>
</html>
