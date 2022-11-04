<?php
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");
session_start();

	if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
}

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
 ?>


<html>
  <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: normal;
    margin-right: 0px;
    font-size: 30px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <style media="screen">
    .button {
      padding: 7px 14px;
      text-align: center;
      display: inline-block;
      font-size: 16px;
    }
    .navbutton {
      padding: 7px 10px;
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
      font-size: 30px;
    }
    font2{
      font-size: 17px;
      display: inline-block;
      margin-top: 0px;
      margin-bottom: 5px;
    }
  </style>
  <head>
    <title>Intake</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <?php
      include_once('navbar.php');
      function verify_sql($stmt){
        if(!isset($stmt)){
            throw new Exception("stmt object is undefined");
        }
        $e = $stmt->errorInfo();
        if($e[0] != '00000'){
            $error = var_export($e, true);
            error_log($error);
            throw new Exception("SQL Error: $error");
        }
     }
  ?>
	<body>
		<div class="col">
		<form class ="form1 form-inline" name="Intake" id="Intake" method="POST">
			<div class = "card cCenter">
			<br><bh><h1>Participant Enrollment</h1></bh><br>
			</div>
			<div class = "card cCenter">
			<br><bh>Add New Participant</bh><br>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="caseNumber">Case Number: </label>
				<input class = "form-control" id="caseNumber" name="caseNumber" placeholder="Case Number" required>
				</div><br>
				<div class = "form-group">
				<label for="ProgramStartDate">Program Start Date:</label>
				<input type="date" class = "form-control" name="ProgramStartDate" required><br>
				</div><br>
			</div>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="prefix">Prefix:</label>
				<select class = "form-control" name="prefix">
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
					<option value="Mrs.">Mrs.</option>
					<option value="Dr.">Dr.</option>
					<option value="Hon.">Hon.</option>
					<option value="Rev.">Rev.</option>
					<option value="Sr.">Sr.</option>
					<option value="Br.">Br.</option>
					<option value="Rabbi">Rabbi</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="firstName">First Name: </label>
				<input class = "form-control" id="firstName" name="firstName" placeholder="First Name" required/>
				</div><br>
				<div class = "form-group">
				<label for="middleName">Middle Name: </label>
				<input class = "form-control" id="middleName" name="middleName" placeholder="Middle Name"/>
				</div><br>
				<div class = "form-group">
				<label for="lastName">Last Name: </label>
				<input class = "form-control" id="lastName" name="lastName" placeholder="Last Name" required/>
				</div><br>
			</div>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="Address1">Address 1: </label>
				<input class = "form-control" id="Address1" name="Address1" placeholder="Address 1" required/>
				</div><br>
				<div class = "form-group">
				<label for="Address2">Address 2: </label>
				<input class = "form-control" id="Address2" name="Address2" placeholder="Address 2"/>
				</div><br>
				<div class = "form-group">
				<label for="zipCode">Zip Code: </label>
				<input class = "form-control" id="zipCode" name="zipCode" placeholder="Zip Code" required/>
				</div><br>
			</div>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="DOB">Date of Birth:</label>
				<input class = "form-control" type="date" id="DOB" name="DOB" required>
				</div><br>
				<div class = "form-group">
				<label for="Gender">Gender:</label>
				<select class = "form-control" name="Gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="race">Race:</label>
				<select class = "form-control" name="race">
				<option value="African-American">African-American</option>
					<option value="Asian">Asian</option>
					<option value="Bi-Racial">Bi-Racial</option>
					<option value="Caucasian">Caucasian</option>
					<option value="Hawaiian or Pacicfic Islander">Hawaiian or Pacicfic Islander</option>
					<option value="Hispanic">Hispanic</option>
					<option value="Multi-Racial">Multi-Racial</option>
					<option value="Native American">Native American</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="maritalStatus">Marital Status:</label>
				<select class = "form-control" name="maritalStatus">
					<option value="Single">Single</option>
					<option value="Married">Married</option>
					<option value="Widowed">Widowed</option>
					<option value="Separated">Separated</option>
					<option value="Divorced">Divorced</option>
					<option value="Domestic Partner">Domestic Partner</option>
					<option value="Common Law">Common Law</option>
				</select>
				</div><br>
			</div>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="email">Email: </label>
				<input class = "form-control" id="email" name="email" placeholder="Email"/>
				</div><br>
				<div class = "form-group">
				<label for="homePhone">Home Phone:</label>
				<input class = "form-control" type="tel" id="homePhone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="homePhone" required>
				</div><br>
			</div>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="careManager">Care Manager:</label>
				<select class = "form-control" name="careManager">
					<option value="None">None</option>
					<option value="Sample1">Sample1</option>
					<option value="Sample2">Sample2</option>
					<option value="Sample3">Sample3</option>
					<option value="Sample4">Sample4</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="DYFSContact">DYFS Contact:</label>
				<select class = "form-control" name="DYFSContact">
					<option value="Sample">Sample</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="referedby">Refered By:</label>
				<select class = "form-control" name="referedby">
					<option value="DD">DD</option>
					<option value="DMHS">DMHS</option>
					<option value="JJC">JJC</option>
					<option value="Juvenile">Juvenile</option>
					<option value="School">School</option>
					<option value="MentalHealthProvider">Mental Health Provider</option>
					<option value="MobileResponse">Mobile Response</option>
					<option value="Other">Other</option>
					<option value="Parent">Parent</option>
					<option value="CCIS">CCIS</option>
					<option value="DCPP">DCPP</option>
					<option value="PreformCare">Prefrom Care</option>
					<option value="CMO">CMO</option>
					<option value="NJAlliance">NJ Alliance FSO</option>
					<option value="Community">Community</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="familyMemberRole">Family Member Role:</label>
				<select class = "form-control" name="familyMemberRole">
					<option value="PrimaryCaregiver">Primary Caregiver</option>
					<option value="CMOChild">CMO Child</option>
					<option value="Sibling">Sibling</option>
					<option value="OtherAdultReletive">Other Adult Reletive</option>
					<option value="Youth">Youth</option>
					<option value="CommunityMember">Community Member</option>
					<option value="CallingOnBehalfOfParent">Calling On Behalf Of Parent</option>
					<option value="Other">Other</option>
				</select>
				</div><br>
				</div>
			</div>
			<div class = "card cCenter" name = "childData">
			<br><bh>Demographic Information</bh><br>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="PriamryLanguage">Primary Language:</label>
				<select class = "form-control" name="PriamryLanguage">
					<option value="English">English</option>
					<option value="Spanish">Spanish</option>
					<option value="CreoleHaitian">Creole Haitian</option>
					<option value="Arabic">Arabic</option>
					<option value="Other">Other</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="OtherLanguage">Other Language:</label>
				<input class = "form-control" name = "OtherLanguage"/>
				</div><br>
				<div class = "form-group">
				<label for="ChildrenReceivingServices">Children Receiving Services:</label>
				<input class = "form-control" type="text" name = "ChildrenReceivingServices"/>
				</div><br>
			</div>
			</div>
			<div class = "card cCenter">
			<br><bh>Only Answer This Section On CMO Child's Record</bh><br>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="CyberNumber">Cyber Number:</label>
				<input class = "form-control" type="text" name = "CyberNumber"/>
				</div><br>
				<div class = "form-group">
				<label for="childsLevelofCare">Child Level of Care:</label>
				<select class = "form-control" name="childsLevelofCare">
					<option value="CMO">CMO</option>
				</select>
				</div><br>
				<div class = "form-group">
				<label for="ChildsPlacement">Childs Placement:</label>
				<select class = "form-control" name="ChildsPlacement">
					<option value="Home">Home</option>
					<option value="FosterHome">FosterHome</option>
					<option value="GroupHome">Group Home</option>
					<option value="Relative">Relative</option>
					<option value="RTC">RTC</option>
					<option value="Shelter">Shelter</option>
					<option value="TheraputicFosterCare">Theraputic Foster Care</option>
					<option value="TreatmentHome">Treatment Home</option>
					<option value="IncarcerationJCC">Incarceration/JCC</option>
					<option value="Runaway">Run Away</option>
					<option value="PsychiatricCommunity">Psychiatric Community</option>
					<option value="CCIS">CCIS</option>
					<option value="IntensiveTreatment">Intensive Res. Treatment Svcs</option>
					<option value="IndependentLiving">Independent Living</option>
					<option value="YouthDetentionCenter">Youth Detention Center</option>
					<option value="Other">Other</option>
				</select>
				</div><br>
			</div>
			<font2> Childs Diagnosis: </font2> <br>
			<div class = "form-check">
				<div>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="ImpulseControl">
					<label for="ImpulseControl">Impulse Control</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="AdjustmentDisorder">
					<label for="AdjustmentDisorder">Adjustment Disorder</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="AttentionDeficient">
					<label for="AttentionDeficient">Attention Deficient</label>
				</div><br>
				</div>
				<div>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="Schizophrenia">
					<label for="Schizophrenia">Schizophrenia</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="MoodDisorder">
					<label for="MoodDisorder">Mood Disorder</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="PervasiveDev">
					<label for="PervasiveDev">Pervasive Development Disorder</label>
				</div><br>
				</div>
				<div>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="AnxientyDisorder">
					<label for="AnxientyDisorder">Anxienty Disorder</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="SubstanceRelated">
					<label for="SubstanceRelated">Substance Related</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="OtherDisorder">
					<label for="OtherDisorder">Other Disorder</label>
				</div><br>
				</div>
				<div>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="OtherCondition">
					<label for="OtherCondition">Other Condition</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="BiPolar">
					<label for="BiPolar">Bi Polar</label>
				</div><br>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="OCD">
					<label for="OCD">OCD</label>
				</div><br>
				</div>
				<div>
				<div class = "form-check-inline">
					<input type="checkbox" name="ChildsDiagnosis[]" value="DDD">
					<label for="DDD">DDD</label>
				</div><br>
				</div>
			</div><br>
			<div class = "form-inline">
				<div class = "form-group">
				<label for="ChildEnrollmentDate">Child Enrollment Date:</label>
				<input type="date" name="ChildEnrollmentDate"/>
				</div><br>
				<div class = "form-group">
				<label for="CMODischargeDate">CMO Discharge Date:</label>
				<input type="date" name="CMODischargeDate"/>
				</div><br>
				<div class = "form-group">
				<label for="CMODischargeStatus">CMO Discharge Status:</label>
				<select class = "form-control" name="CMODischargeStatus">
					<option value="T1">T1:Child/Family successfully complete program</option>
					<option value="T2">T2:Family/child declined services</option>
					<option value="T3">T3:Attempts to engage family unsuccesful and/or non-complience with services</option>
					<option value="T4">T4:Child Missing</option>
					<option value="T5">T5:Child Transitioned to adult services</option>
					<option value="T6">T6:Family moved out of geographic area</option>
					<option value="T7">T7:Family requested discharge</option>
					<option value="T8">T8:Child Sentenced to Jamesburg(TSB) or prison</option>
					<option value="T9">T9:PCE Services not appropriate</option>
					<option value="T10">T10:Refering agency requested discharge</option>
					<option value="T11">T11:N/A</option>
					<option value="T12">T12:Deceased</option>
				</select>
				</div><br>
			</div>
			<br>
			<div class = "form-group">
				<label for="DCPP">DCPP Involvement:</label>
				<input type="radio" name="DCPP" value="Yes">Yes </input>
				<input type="radio" name="DCPP" value="No"> No </input>
			</div><br>
			<div class = "form-group">
				<label for="CourtInvolvement">Court Involvement:</label>
				<input type="radio" name="CourtInvolvement" value="Yes">Yes </input>
				<input type="radio" name="CourtInvolvement" value="No">No </input>
			</div><br>
			</div>
			<div class = "card cCenter">
			<input type="submit" name="register"/>
			</div>
		</form>
		</div>
	</body>
</html>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

if($_POST){
	//var_dump($_POST);
	//var_dump($_POST["firstName"]);

	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		
		$stmt = $db->prepare("INSERT INTO `address`
                        VALUES (:address1, :address2, :city, :zip, :county, DEFAULT, DEFAULT, DEFAULT)");

		$params = array(
      ":address1"=> $_POST["Address1"], 
      ":address2"=> $_POST["Address2"], 
      ":city" => $_POST["city"],
      ":zip"=> $_POST["zipCode"], 
      ":county"=> NULL);
						
		$result = $stmt->execute($params);
    verify_sql($stmt);
    if($result){
      echo "Address registered successfully";
      }
      else{
          echo "Registration error: address";
      }
												
		$address_id = intval($db->lastInsertId());
		
		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

    $stmt = $db->prepare("INSERT INTO `personal_info`
                    VALUES (:firstname, :lastname, :prefix, :middlename, :gender, :dob, :race, 
                    :home_phone, :email, :maritalstatus, :referred,:familymemberrole, :primarylanguage, 
                    :otherlanguage, :childrenreceivingservices, :address_id, DEFAULT)");

		$params = array(
      ":firstname"=> $_POST["firstName"],
      ":lastname"=> $_POST["lastName"], 
      ":prefix"=> $_POST["prefix"],
			":middlename"=> $_POST["middleName"],
      ":dob"=> $_POST["DOB"], 
			":gender"=> $_POST["Gender"], 
      ":race"=> $_POST["race"], 
      ":home_phone"=>$_POST["homePhone"], 
      ":email"=> $_POST["email"], 
      ":maritalstatus"=> $_POST["maritalStatus"], 
      ":referred"=> $_POST["referedby"],
			":familymemberrole"=> $_POST["familyMemberRole"], 
      ":primarylanguage"=> $_POST["PriamryLanguage"], 
      ":otherlanguage"=> $_POST["OtherLanguage"],
			":childrenreceivingservices"=> $_POST["ChildrenReceivingServices"],
      //":cell_phone"=>$_POST["homePhone"]
      ":address_id" => $address_id
      );
						
		$result = $stmt->execute($params);
    verify_sql($stmt);
    if($result){
      echo "Family registered successfully";
      }
      else{
          echo "Registration error: family";
      }
						
		$person_id = intval($db->lastInsertId());
		
		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";

		if( $_POST['CyberNumber'] != NULL){

			if ($_POST["ChildsDiagnosis"]){
			$child_str = implode (", ", $_POST["ChildsDiagnosis"]);
			}

			else{
				$child_str = NULL;
			}
			$stmt = $db->prepare("INSERT INTO `family`
                        VALUES (DEFAULT, :maritalstatus, :referred,:familymemberrole, :primarylanguage, :otherlanguage, 
								:childrenreceivingservices, :cybernumber,:childlevelcare,:childplacement,:childDiagnosis,
								:childenrollmentedate, :cmodischargedate, :cmostatus, :dcppinvolvement, :courtinvolvement, :uid, :address_id, :person_id)");

		$params = array(
      ":maritalstatus"=> $_POST["maritalStatus"], 
      ":referred"=> $_POST["referedby"],
			":familymemberrole"=> $_POST["familyMemberRole"], 
      ":primarylanguage"=> $_POST["PriamryLanguage"], 
      ":otherlanguage"=> $_POST["OtherLanguage"],
			":childrenreceivingservices"=> $_POST["ChildrenReceivingServices"],
      ":cybernumber"=> $_POST["CyberNumber"],
      ":childlevelcare"=> $_POST["childsLevelofCare"],
			":childplacement"=> $_POST["ChildsPlacement"],
      ":childDiagnosis"=> $child_str,
      ":childenrollmentedate"=> $_POST["ChildEnrollmentDate"],
			":cmodischargedate"=> $_POST["CMODischargeDate"],
      ":cmostatus"=> $_POST["CMODischargeStatus"],
      ":dcppinvolvement"=> $_POST["DCPP"],
      ":courtinvolvement"=> $_POST["CourtInvolvement"], 
			":uid"=>intval($_SESSION["ID"]), 
      ":address_id"=> $address_id, 
      ":person_id"=> $person_id );
		}

		else {

		 $stmt = $db->prepare("INSERT INTO `family`
                        VALUES (DEFAULT, :maritalstatus, :referred,:familymemberrole,
								:primarylanguage, :otherlanguage, :childrenreceivingservices, :cybernumber,:childlevelcare,:childplacement,:childDiagnosis,
								:childenrollmentedate, :cmodischargedate, :cmostatus, :dcppinvolvement, :courtinvolvement, :uid,:address_id, :person_id)");

		$params = array(":maritalstatus"=> $_POST["maritalStatus"], ":referred"=> $_POST["referedby"], ":familymemberrole"=> $_POST["familyMemberRole"], 
						":primarylanguage"=> $_POST["PriamryLanguage"], ":otherlanguage"=> $_POST["OtherLanguage"], ":childrenreceivingservices"=> $_POST["ChildrenReceivingServices"],  
						":cybernumber"=> NULL,":childlevelcare"=> NULL,":childplacement"=> NULL,":childDiagnosis"=> NULL,
						":childenrollmentedate"=> NULL, ":cmodischargedate"=> NULL,":cmostatus"=> NULL,":dcppinvolvement"=> NULL,
						":courtinvolvement"=> NULL, ":uid"=>intval($_SESSION["ID"]), ":address_id"=> $address_id, ":person_id"=> $person_id);
		}
		$stmt->execute($params);
		#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		$id = intval($db->lastInsertId());

		$stmt1 = $db->prepare("INSERT INTO `cases` VALUES (:programstartdate, :casenumber, :caremanager, :dyfscontact, :id, DEFAULT)");

		$params1 = array(":programstartdate"=> $_POST["ProgramStartDate"],":casenumber"=> $_POST["caseNumber"],":caremanager"=> $_POST["careManager"],
						":dyfscontact"=> $_POST["DYFSContact"], ":id"=> $id);
		$stmt1->execute($params1);



		#var_dump($id);
        #echo "<pre>" . var_export($stmt1->errorInfo(), true) . "</pre>";
        }
        catch(Exception $e){
                echo $e->getMessage();
                //exit();
        }
	}



?>
