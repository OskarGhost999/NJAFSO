<?php
require("config.php");
session_start();
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

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
    <title>Outreach</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <style media="screen">
    .button {
      padding: 7px 14px;
      text-align: center;
      display: inline-block;
      font-size: 16px;
    }
    .form1 br{
      margin-bottom: 1em;
      display:inline-block;
    }
    .form1 input{
      margin:5px;
    }
    .form1 select{
      margin:5px;
    }
    .form1 font{
      font-size: 20px;
    }
    body{
      background-color: #e0f5f5;
    }
    bh{
      margin-left: -2px;
      font-weight: normal;
      font-size: 30px;
      font-family: 'Poppins', sans-serif;
    }    
  </style>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <?php
      include_once('navbar.php');
  ?>
  <body>
  <div class="col">
    <br>
    <bh>Warmline Contact Form</bh><br>
    <form class="form1" name="Warmlines" id="Warmlines" method="POST">
      <label for="contactLocation">Contact Location:</label>
      <select name="contactLocation">
        <option value=""  disabled selected>--Select--</option>
        <option value="Program Site">At Program Site</option>
        <option value="Child Family Team">Child Family Team</option>
        <option value="Church">Church</option>
        <option value="Court">Court</option>
        <option value="Family Home Vist">Family Home Vist</option>
        <option value="Hospital">Hospital</option>
        <option value="Host Event">Host Event</option>
        <option value="Initial Strengths and Needs">Initial Strengths and Needs</option>
        <option value="Mail">Mail</option>
        <option value="Meet and Greet">Meet and Greet</option>
        <option value="Meeting">Meeting</option>
        <option value="On the Phone">On the Phone</option>
        <option value="On the Street">On the Street</option>
        <option value="Other Location in the Community">Other Location in the Community</option>
        <option value="Other Phone Call">Other Phone Call</option>
        <option value="Partner Agency">Partner Agency</option>
        <option value="Phone call to CMO">Phone call to CMO</option>
        <option value="Phone call to family">Phone call to family</option>
        <option value="Research Resources">Other Phone Call</option>
        <option value="School">Partner Agency</option>
        <option value="Transportation">Transportation</option>
        <option value="WL Research/Collateral Call">WL Research/Collateral Call</option>
        <option value="Youth Event">Youth Event</option>
      </select><br>
      <label for="SupportLevel">Support Level:</label>
      <select name="SupportLevel">
      <option value=""  disabled selected>--Select--</option>
        <option value="Low Level of Support">Low Level of Support</option>
        <option value="Moderate Level of Support">Moderate Level of Support</option>
        <option value="High Level of Support">High Level of Support</option>
      </select><br>
      <label for="TypeOfCaller">Type Of Caller:</label>
      <select name="TypeOfCaller">
      <option value=""  disabled selected>--Select--</option>
        <option value="Parent">Parent</option>
        <option value="Grandparent">Grandparent</option>
        <option value="Someone Calling on Behalf">Someone Calling on Behalf</option>
        <option value="Child/Youth">Child/Youth</option>
        <option value="Previous CMO Family">Previous CMO Family</option>
        <option value="Other: specify in notes">Other: specify in notes</option>
        <option value="Returning CMO Family">Returning CMO Family</option>
      </select><br>
      <label for="CallerRefered">Caller Refered By:</label>
      <select name="CallerRefered">
      <option value=""  disabled selected>--Select--</option>
        <option value="DCPP">DCPP</option>
        <option value="Web Or Internet">Web/Internet</option>
        <option value="Mobile Response">Mobile Response</option>
        <option value="NAMI">NAMI</option>
        <option value="PreformCare">Preform Care</option>
        <option value="Counselor">Counselor</option>
        <option value="CSA">CSA</option>
        <option value="SPAN">SPAN</option>
        <option value="School">School</option>
        <option value="Other: specify in notes">Other: specify in notes</option>
        <option value="CMO">CMO</option>
        <option value="Family Success Center">Family Success Center</option>
        <option value="Parents Anonymous">Parents Anonymous</option>
        <option value="Previous CMO Family">Previous CMO Family</option>
      </select><br>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
<br>
  <bh>Reason for Call/Issues Disscused:</bh><br>

      <input type="checkbox" name="Reason[]" value="Food">
      <label for="Food">Food</label><br>

      <input type="checkbox" name="Reason[]" value="Mental Health">
      <label for="MentalHealth">Mental Health</label><br>

      <input type="checkbox" name="Reason[]" value="Transportation">
      <label for="Transportation">Transportation</label><br>

      <input type="checkbox" name="Reason[]" value="DomesticViolence">
      <label for="DomesticViolence">Domestic Violence</label><br>

      <input type="checkbox" name="Reason[]" value="MedicalInformation">
      <label for="MedicalInformation">Medical Information</label><br>

      <input type="checkbox" name="Reason[]" value="Shelter">
      <label for="Shelter">Shelter</label><br>

      <input type="checkbox" name="Reason[]" value="School">
      <label for="School">School</label><br>

      <input type="checkbox" name="Reason[]" value="Leagal">
      <label for="Leagal">Leagal</label><br>

      <input type="checkbox" name="Reason[]" value="Housing">
      <label for="Housing">Housing</label><br>

      <input type="checkbox" name="Reason[]" value="Employment">
      <label for="Employment">Employment</label><br>

      <input type="checkbox" name="Reason[]" value="Custody">
      <label for="Custody">Custody</label><br>

      <input type="checkbox" name="Reason[]" value="FamilySatisfactionSurvey">
      <label for="FamilySatisfactionSurvey">Family Satisfaction Survey</label><br>

      <input type="checkbox" name="Reason[]" value="DDD">
      <label for="DDD">DDD</label><br>

      <input type="checkbox" name="Reason[]" value="SubstanceRelated">
      <label for="SubstanceRelated">Substance Related Issue/Program</label><br>

      <input type="checkbox" name="Reason[]" value="SubstanceAbuseRelated">
      <label for="SubstanceAbuseRelated">Substance Abuse Related/Treatment</label><br>

      <bh>Resources/Referrals:</bh><br>

      <input type="checkbox" name="Resources[]" value="NewsLetter">
      <label for="NewsLetter">News Letter</label><br>

      <input type="checkbox" name="Resources[]" value="Workshop">
      <label for="Workshop">Workshop</label><br>

      <input type="checkbox" name="Resources[]" value="FamilySupport">
      <label for="FamilySupport">Family Support</label><br>

      <input type="checkbox" name="Resources[]" value="YouthPartnership">
      <label for="YouthPartnership">Youth Partnership</label><br>

      <input type="checkbox" name="Resources[]" value="Presentation">
      <label for="Presentation">Presentation</label><br>

      <input type="checkbox" name="Resources[]" value="Training">
      <label for="Training">Training</label><br>

      <input type="checkbox" name="Resources[]" value="SupportGroup">
      <label for="SupportGroup">Support Group</label><br>

      <input type="checkbox" name="Resources[]" value="SupportTelephoneCouseling">
      <label for="SupportTelephoneCouseling">Support Telephone Counseling</label><br>

      <input type="checkbox" name="Resources[]" value="OtherCommunityResource">
      <label for="OtherCommunityResource">Other Community Resource</label><br>

      <input type="checkbox" name="Resources[]" value="PreformCare">
      <label for="PreformCare">Preform Care</label><br>

      <input type="checkbox" name="Resources[]" value="DDD">
      <label for="DDD">DDD</label><br>

      <input type="checkbox" name="Resources[]" value="SubstanceRelated">
      <label for="SubstanceRelated">Substance Related Issue/Program</label><br>

      <input type="checkbox" name="Resources[]" value="SubstanceAbuseRelated">
      <label for="SubstanceAbuseRelated">Substance Abuse Related/Treatment</label><br>

      <input type="checkbox" name="Resources[]" value="PEP">
      <label for="PEP">PEP/Parents Anonymous</label><br>

      <label for="TimeSpentSupport">Time Spent - Support Level</label>
      <input type="number" name="TimeSpentSupport"> Minutes</input><br>

      <bh>Notes:</bh><br>
      <textarea form="Warmlines" name="Notes" rows="5" cols="80"></textarea><br>

      <label for="WarmlineContact">Warmline Contact:</label>
      <select name="WarmlineContact">
      <option value=""  disabled selected>--Select--</option>
        <option value="Low Level of Support">Low Level of Support</option>
        <option value="Moderate Level of Support">Moderate Level of Support</option>
        <option value="High Level of Support">High Level of Support</option>
      </select><br>

      <label for="TimeSpentWarm">Time Spent - Warmline Contact</label>
      <input type="number" name="TimeSpentWarm"> Minutes</input><br>
	   <input class="button" type="submit" name="register"/>
    </form>
    </div>
  </body>
</html>

<?php

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

if($_POST){
	//var_dump($_POST["firstName"]);

	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("INSERT INTO `warmline`
							VALUES (:contactLocation, :supportlevel, :typeofcaller, :callerreferedby, :reasonforcall, :resources, :timespentsupport,
									:notes, :warmcontact, :timespentwarm, :uid, DEFAULT)");

		if ($_POST["Reason"]){
			$reason_str = implode (", ", $_POST["Reason"]);
		}

		else{
			$reason_str = NULL;
		}

		if ($_POST["Resources"]){
			$resources_str = implode (", ", $_POST["Resources"]);
		}

		else{
			$resources_str = NULL;
		}


		$params = array(":contactLocation"=> $_POST["contactLocation"],":supportlevel"=> $_POST["SupportLevel"], ":timespentsupport"=> $_POST["TimeSpentSupport"],
						":typeofcaller"=> $_POST["TypeOfCaller"], ":callerreferedby"=> $_POST["CallerRefered"], ":reasonforcall"=> $reason_str,
						":resources"=> $resources_str, ":notes"=> $_POST["Notes"], ":warmcontact"=> $_POST["WarmlineContact"], ":timespentwarm"=> $_POST["TimeSpentWarm"],":uid"=>intval($_SESSION["ID"]));
		$stmt->execute($params);

		//$id = $db->lastInsertId();



		//var_dump($id);
        //echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
        }
        catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}
 ?>
