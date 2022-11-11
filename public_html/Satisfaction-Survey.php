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
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
//$stmt = $db->prepare('SELECT fid, uid, person_id FROM family WHERE uid=:id');
$stmt = $db->prepare('SELECT person_id, user_id FROM personal_info WHERE user_id=:id');
$stmt->execute(['id' => intval($_SESSION["ID"])]);
$data = $stmt->fetchAll();

 ?>

<html lang="en" dir="ltr">
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 30px;
    padding: 0px;
    font-family: 'Poppins', sans-serif;
    } 
  </style>


  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <style>
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
      font-size: 30px;
    }
    font2{
      font-size: 17px;
      display: inline-block;
      margin-top: 0px;
      margin-bottom: 5px;
    }
  </style>
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
  <div class="lead text-center">
    <h1 class="display-4">Satisfaction Survey</h1>
</div>
    <div class="col">
    <div class="container">
      <div class = "card" style="background-color: #7dcbd4; border-radius:25px">
      <div class="card-body">
    <form class ="form1" name="Intake" id="Intake" method="POST">
<br>
      <label for="prompt">Select the Family:</label>
	  <br>
    <!--changed select name value from family to person -->
      <select name="person" required>
        <option value=""  disabled selected>--Select--</option>
		<?php foreach ($data as $row) {
			$stmt = $db->prepare('SELECT firstname, lastname FROM personal_info WHERE person_id=:id');
			$stmt->execute(['id' => $row['person_id']]);
			$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
			#var_dump($data2);

			?>
      <!-- person_id from fid -->
		<option value= <?php echo $row["person_id"]; ?> > <?php echo $data2[0]["firstname"]; echo " "; echo $data2[0]["lastname"]; echo " "; echo $row["person_id"];}?> </option>
      </select><br><br></option>
	  <label for="prompt">The FSO staff provided services promptly and efficiently.</label>
      <br>
      <select name="prompt" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="curteous">The FSO staff was curteous and professional.</label>
      <br>
      <select name="curteous" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="informed">The FSO staff was informed or made an effort to get the information needed to assist me.</label>
      <br>
      <select name="informed" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="answerQuestions">The FSO staff was knowledgable and able to answer my questions.</label>
      <br>
      <select name="answerQuestions" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="advocacySkills">The FSO staff model self-advocacy skills for me.</label>
      <br>
      <select name="advocacySkills" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="progress">The services that I received helped me to make progress towards my family's goals.</label>
      <br>
      <select name="progress" required>
        <option value="" disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="qualityOfLife">The quality of life in our home has improved as a result of the services provided by the FSO.</label>
      <br>
      <select name="qualityOfLife" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <label for="recommend">I would recommend the FSO services to other families.</label>
      <br>
      <select name="recommend" required>
        <option value=""  disabled selected>--Select--</option>
        <option value="Strongly Agree">Strongly Agree</option>
        <option value="Agree">Agree</option>
        <option value="Neutral">Neutral</option>
        <option value="Disagree">Disagree</option>
        <option value="Strongly Disagree">Strongly Disagree</option>
      </select><br>
      <input class="button" type="submit" name="submit"/>
    </form>
    </div>
  </body>
</html>

<?php
	if($_POST){

		try{
			$stmt = $db->prepare("INSERT INTO `survey`
                        VALUES (DEFAULT, :prompt,:court,:inform,:knowledge,:advocacy,:goals,:qol,:recommend,:fid, :person_id, DEFAULT, DEFAULT)");
			$params = array(
        ":prompt"=> $_POST["prompt"],
        ":court"=> $_POST["curteous"], 
        ":inform"=> $_POST["informed"],
        ":knowledge"=> $_POST["answerQuestions"],
        ":advocacy"=> $_POST["advocacySkills"],
				":goals"=> $_POST["progress"],
        ":qol"=> $_POST["qualityOfLife"],
        ":recommend"=> $_POST["recommend"], 
        ":fid"=> NULL, //$_POST["family"]
				":person_id" => $_POST["person"],
        );
			
			#var_dump($stmt);
			//$stmt->execute($params);
    $result = $stmt->execute($params);
    verify_sql($stmt);
    if($result) {
      echo "Survey submitted successfully";
      }
      else{
          echo "Survey submission error";
          //var_export($result);
      }
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}

 ?>
