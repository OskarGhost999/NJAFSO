<?php

require("config.php");
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

	if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
}
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

$db= new PDO($connection_string, $dbuser, $dbpass);
#$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
//$stmt = $db->prepare('SELECT fid, uid,person_id FROM family WHERE uid=:id');
$stmt = $db->prepare('SELECT user_id, person_id FROM personal_info WHERE user_id=:id');
$stmt->execute(['id' => intval($_SESSION["ID"])]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$counter = 0;
#var_dump($data);

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
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
  <br>
<html lang="en" dir="ltr">
  <style media="screen">
    purple{
      color: purple;
    }
  </style>
  <head>
    <meta charset="utf-8">
    <title>FANS Assesment</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #e0f5f5;">
  <div class="lead text-center">
    <h1 class="display-4">FANS Assesment Survey</h1>
</div>
    <div class="col">
    <div class="container">
      <div class = "card" style="background-color: #7dcbd4; border-radius:25px">
      <div class="card-body">
    <form class="form1" name="mainForm" id="mainForm" method="post" enctype="multipart/form-data">

	<label>Select the Family:</label>
	  <br>
    <!-- select name changed to person from family -->
      <select name="person" required>
        <option value=""  disabled selected>Select an Option</option>

		<?php foreach ($data as $row) {
			$stmt = $db->prepare('SELECT firstname, lastname FROM personal_info WHERE person_id=:id');
			$stmt->execute(['id' => $row['person_id']]);
			$data2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
			#var_dump($data2);

			?>
      <!-- person_id where fid was -->
		<option value= <?php echo $row["person_id"]; ?> > <?php echo $data2[0]["firstname"]; echo " "; echo $data2[0]["lastname"]; echo " "; echo $row["person_id"];}?> </option>
      </select><br><br><br><br>

      <purple>
        The mission of the Family Support Organization is to provide families with Support, Education and Advocacy.
        Completion of this questionnaire serves as the basis for your ongoing action plan.
      </purple>
      <br>
      Your action plan guides the partnership between you and your Family Support Partner. This tool will help you monitor
      progress toward your goals and identify your family's success.
      <br>
      <b>NOTE:</b> If a characteristic or statement does not apply to you, and you are not interested in pursuing an activity
      reflected in the statement please rate the response as a "3" and do not include any follow up goal in the action plan.
      <br>
      <b>CAREGIVERS' COLLABORATION:</b>This item refers to how well you and the other adults involved in the raising of
      your youth work together.
      <br>
      (0) <purple>Healthy collaboration.</purple> We usually work together regarding issues of the development and well-being of our youth.
      We are able to negotiate disagreements related to our youth
      <br>
      (1) <purple>Mostly healthy collaboration.</purple> Generally good collaboration with occasional difficulties negotiating
      miscommunications or misunderstandings regarding issues of the development and well-being of our youth.
      <br>
      (2) <purple>Limited healthy collaboration.</purple> Moderate problems of communication and collaboration between us with regard to
      issues of the development and well-being of our youth.
      <br>
      (3) <purple>Significant difficulties with collaboration.</purple> Minimal collaboration and destructive or sabotaging communication
      regarding issues related to the development and well-being of our youth.
      <br>
      (3) <purple>There is only one caregiver</purple><br><br>



      <select name="CaregiverCollab" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - Caregivers Collaboration - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCollab" rows="5" cols="80"></textarea>
      <br><br>

      <b>FAMILY COMMUNICATION:</b> This item refers to how well family members communicate with each other.
      <br>
      (0) <purple>Healthy communication.</purple> Family members generally are able to communicate directly about important information
      among each other.
      <br>
      (1) <purple>Mostly healthy communication.</purple> Family members sometimes have challenges communicating or some topics are
      excluded from direct communication.
      <br>
      (2) <purple>Limited healthy communication.</purple> Family members generally are unable to communicate directly important
      information among each other.
      <br>
      (3) <purple>Significant difficulties with communication.</purple> Family members communicate mostly through indirect means, or there
      is no sharing of important information at all. We are not able to understand each other.
      <br><br>
      <select name="FamilyComm" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - FAMILY COMMUNICATION - with score of 2 or 3<br>
      <textarea form="mainForm" name="APFamilyComm" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER FAMILY AND SOCIAL RESOURCES:</b> Social resources could include friends, extended family
      members, places of worship, or other organizations that help the family in times of need.
      <br>
      (0) <purple>I/we have social resources</purple> that actively support me and my family, and I/we am comfortable asking them for help
      when needed.
      <br>
      (1) <purple>I/we have some social resources</purple> that actively help me and my family. I/we are usually comfortable asking for
      support from them.
      <br>
      (2) <purple>I/we have no social resources</purple> that may be able to help myself and my family, or I/we have some resources but
      I/we have difficulty asking for support from them.
      <br>
      (3) <purple>I/we have no family or social network</purple> that may be able to help myself and my family.
      <br><br>
      <select name="FamilySocial" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER FAMILY AND SOCIAL RESOURCES - with score of 2 or 3<br>
      <textarea form="mainForm" name="APFamilySocial" rows="5" cols="80"></textarea>
      <br><br>

      <b>FAMILY SAFETY:</b> This item refers to how safe you and other family members feel in your home. Are some family
      members engaging in behavior that can hurt other family members? This item does not refer to safety risks in the
      neighborhood.
      <br>
      (0) <purple>No risk.</purple> Our family provides a safe home environment for all family members.
      <br>
      (1) <purple>Mild risk.</purple> Our family home environment presents some mild exposure of undesirable influences but I/we see no
      immediate risk.
      <br>
      (2) <purple>Moderate risk.</purple> Our family home environment presents a moderate risks to family members.
      <br>
      (3) <purple>Severe risk.</purple> Our family home environment presents a clear and immediate risk of harm to family members.
      <br><br>
      <select name="FamilySafty" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - FAMILY SAFETY - with score of 2 or 3<br>
      <textarea form="mainForm" name="APFamilySaftyl" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER OPTIMISM (HOPEFULNESS):</b> This item refers to your sense of the future, regardless of how
      overwhelmed you may feel in the present.
      <br>
      (0) <purple>I/we have a strong and stable optimistic outlook on my life.</purple> I/we generally believe that things will get better in the
      future.
      <br>
      (1) <purple>Most of the time, I/we can imagine positive things happening in my life,</purple> although at times I/we may lose that
      positive view.
      <br>
      (2) <purple>I/we have difficulties maintaining a positive view of my future.</purple> I/we often feel there is little hope for a good future
      for me.
      <br>
      (3) <purple>I/we rarely or never see anything positive about my future.</purple>
      <br><br>

      <select name="CareOpt" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER OPTIMISM - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCareOpt" rows="5" cols="80"></textarea>
      <br><br>

      <b>SPIRITUAL:</b> This item refers to your involvement in spiritual beliefs and activities as a source for you.
      <br>
      (0) <purple>I/we have strongly held spiritual beliefs</purple> that sustain or comfort me in difficult times.
      <br>
      (1) <purple>I/we have spiritual beliefs</purple> that I often find comfort in.
      <br>
      (2) <purple>I/we have or had some spiritual beliefs</purple>, but at this time, I do not find comfort in them. This rating could also be
      used to indicate that I/we are questioning current beliefs or that I have an interest in exploring my beliefs further.
      <br>
      (3) <purple>I do not hold any spiritual or beliefs</purple> and do not wish to pursue any, or I have a significant desire to pursue such
      involvement/affiliation.
      <br>
      <b>Note:</b> Rate item as a 3 if there is no spiritual belief system but do not create an action.
      <br><br>

      <select name="spirit" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - SPIRITUAL - with score of 2 or 3<br>
      <textarea form="mainForm" name="APspirit" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER ORGANIZATION SKILLS:</b> This item refers to your ability to organize the household to support your
      youth. This question is not about how neat, clean, or orderly your house is.
      <br>
      (0) <purple>I/we am well organized and efficient</purple>, and I/we am able to maintain my youth's services, appointments, medication,
      etc.
      <br>
      (1) <purple>I/we have occasional difficulties with organizing</purple> and maintaining my household to support my youth's needs. For
      example, I/we may be forgetful about some appointments.
      <br>
      (2) <purple>I/we have moderate difficulty organizing</purple> and maintaining household to support my youth's needs.
      <br>
      (3) <purple>I/we have severe difficulty managing my household.</purple> I/we am unable to organize or manage my household to
      support my youth's needs.
      <br><br>

      <select name="CareOrg" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER ORGANIZATION SKILLS - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCareOrg" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER SELF CARE:</b> This item refers to your ability to find time for yourself and to use this time as a source of
      inner strength. This could involve participating in hobbies, spiritual activities, wellness behaviors, etc. which in turn
      help you to feel better about yourself, are relaxing, and/or help you to cope with stress better.
      <br>
      (0) <purple>Good use of personal time.</purple> I/we engage in activities that I/we enjoy. I/we effectively use these activities as a
      coping mechanism.
      <br>
      (1) <purple>I/we usually find ways to structure my free time into daily routines</purple> that help me to cope.
      <br>
      (2) <purple>I/we have limited activities or limited ability</purple> to use them as effective coping mechanisms.
      <br>
      (3) <purple>I/we have no time for self care.</purple>
      <br><br>

      <select name="CareSelfCare" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER SELF CARE - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCareSelfCare" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER STRESSORS:</b> This item reflects the degree of stress or burden that you may be experiencing as a
      result of various situations in your life. These could include stressors such as housing problems, violence in the
      neighborhood, traumatic events in your past, the youth's needs, etc.
      <br>
      (0) <purple>I/we have some stressors</purple>, but I/we do not feel overwhelmed.
      <br>
      (1) <purple>I/we have some stressors</purple>, and at times have difficulty managing them.
      <br>
      (2) <purple>I/we have significant stressors</purple> and I/we frequently feel overwhelmed.
      <br>
      (3) <purple>I/we have significant stressors</purple> and I/we need support to manage the stress associated with them.
      <br><br>

      <select name="CareStress" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER STRESSORS - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCareStress" rows="5" cols="80"></textarea>
      <br><br>

      <b>CAREGIVER SELF-EFFICACY:</b> This item refers to your ability to identify and use events and/or internal strengths to
      manage your life.
      <br>
      (0) <purple>I/we am able to both identify and use strengths</purple> to successfully manage difficult challenges.
      <br>
      (1) <purple>I/we am able to identify most of my strengths</purple> and I am able to partially utilize them.
      <br>
      (2) <purple>I/we am not able to both identify</purple> and/or to use them effectively.
      <br>
      (3) <purple>I/we am not yet able to identify</purple> personal strengths.
      <br><br>

      <select name="CareEff" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - CAREGIVER SELF-EFFICACY - with score of 2 or 3<br>
      <textarea form="mainForm" name="APCareEff" rows="5" cols="80"></textarea>
      <br><br>

      <b>KNOWLEDGE OF FAMILY/YOUTH NEEDS:</b> The goal of this item is to see whether there is information needed for
      you to be more effective in helping your family.
      <br>
      (0) <purple>I/we have an understanding</purple> of my family's strengths, needs, and limitations.
      <br>
      (1) <purple>I/we have an understanding</purple> of my family's strengths, needs, and limitations, but require some help in learning
      about certain aspects of these needs.
      <br>
      (2) <purple>I/we am sometimes told things about my child by professionals or others that I find confusing or do not fully
      understand.</purple> I/we may require assistance in understanding my family's strengths and needs.
      <br>
      (3) <purple>I/we require substantial assistance</purple> in identifying and understanding my family's strengths and needs.
      <br><br>

      <select name="KnowledgeFam" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - KNOWLEDGE OF FAMILY/YOUTH NEEDS - with score of 2 or 3<br>
      <textarea form="mainForm" name="APKnowledgeFam" rows="5" cols="80"></textarea>
      <br><br>

      <b>KNOWLEDGE OF THE CHILDREN'S SYSTEM OF CARE (CSOC):</b> This item refers to your understanding of CSOC
      and the Wraparound model, which includes the Family Support Organization (FSO), Care Management Organization
      (CMO), and Mobile Response & Stabilization (MRSS).
      <br>
      (0) <purple>I/we have a strong understanding</purple> of the Wraparound Model and service options within the NJ Children's System
      of Care.
      <br>
      (1) <purple>I/we have some understanding</purple> of the Wraparound Model and the NJ CSOC, but may still require some help in
      learning about certain aspects/options.
      <br>
      (2) <purple>I/we have limited knowledge</purple> about how Wraparound and/or the NJ CSOC work. What options are available or
      how to access them. I/we could use some help with this.
      <br>
      (3) <purple>I/we know almost nothing</purple> about Wraparound and the NJ CSOC and require substantial support identifying and
      understanding Wraparound or the NJ CSOC.
      <br>

      <select name="KnowCSOC" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - KNOWLEDGE OF THE CHILDREN'S SYSTEM OF CARE - with score of 2 or 3<br>
      <textarea form="mainForm" name="APKnowCSOC" rows="5" cols="80"></textarea>
      <br><br>

      <b>KNOWLEDGE OF COMMUNITY RESOURCES:</b> This item refers to your understanding of resources other than
      those available through NJ CSOC and how to access them. Such programs might include (but are not limited to):
      support groups, wellness programs, caregiver education programs, and Division of Child Protection and Permanency
      (DCP&P).
      <br>
      (0) <purple>I/we have a strong understanding</purple> of community resources and how to access them.
      <br>
      (1) <purple>I/we have an understanding</purple> of community resources but occasionally may still require some help in learning about
      certain aspects of these services.
      <br>
      (2) <purple>I/we require support in understanding</purple> what community resources are available and how to access them.
      <br>
      (3) <purple>I/we require substantial support in identifying and understanding</purple> any community resource.
      <br><br>

      <select name="KnowCommu" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - KNOWLEDGE OF COMMUNITY RESOURCES - with score of 2 or 3<br>
      <textarea form="mainForm" name="APKnowCommu" rows="5" cols="80"></textarea>
      <br><br>

      <b>KNOWLEDGE OF RIGHTS AND RESPONSIBILITIES:</b> This item refers to your understanding of the legal and other
      rights and responsibilities you have as a caregiver. Examples are (but not limited to): education, guardianship,
      disability, transitioning to the adult system, and participating in meetings ( Child Family Team meetings, Individualized
      Education Plan, etc.)<br>
      (0) <purple>I/we have a strong understanding</purple> of our rights and responsibilities.
      <br>
      (1) <purple>I/we have an understanding</purple> of our rights and responsibilities but may still require some support in learning about
      certain aspects of them.
      <br>
      (2) <purple>I/we require assistance in understanding</purple> our rights and responsibilities. These have not been explained to me in a
      way that I/we can understand.
      <br>
      (3) <purple>I/we require substantial support</purple> in identifying and understanding our rights and responsibilities.
      <br><br>

      <select name="KnowRight" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - KNOWLEDGE OF RIGHTS AND RESPONSIBILITIES - with score of 2 or 3<br>
      <textarea form="mainForm" name="APKnowRight" rows="5" cols="80"></textarea>
      <br><br>

      <b>ABILITY TO COMMUNICATE:</b> This item relates to the importance of family "voice and choice", including teamwork,
      decision making, and problem solving. It enables you to communicate even negative or difficult messages without
      creating conflict or mistrust.
      <br>
      (0) <purple>I/we am able to hear both good and bad news</purple> and to communicate effectively
      <br>
      (1) <purple>I/we sometimes struggle to communicate</purple> my concerns so that others will listen or understand.
      <br>
      (2) <purple>I/we require some support to communicate</purple> my concerns so others will listen and understand
      <br>
      (3) <purple>I/we require substantial support to communicate</purple> my concerns so that others will listen and understand.
      <br><br>

      <select name="AbilityComm" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - ABILITY TO COMMUNICATE - with score of 2 or 3<br>
      <textarea form="mainForm" name="APAbilityComm" rows="5" cols="80"></textarea>
      <br><br>

      <b>ABILITY TO ADVOCATE:</b> This item refers to your ability to advocate for yourself, your youth, and your family with
      various systems and agencies including schools, child welfare, health, juvenile justice, NJ CSOC partners, etc.
      <br>
      (0) <purple>I/we am able to advocate effectively</purple> on behalf of myself, my youth, and my family.
      <br>
      (1) <purple>I/we am usually able to advocate</purple> for myself, my youth, and my family with most of the systems with which I/we
      interact.
      <br>
      (2) <purple>I/we am rarely able to advocate effectively</purple> on behalf of myself, my youth, or my family and may need some
      support with doing so.
      <br>
      (3) <purple>I/we am not able to advocate effectively</purple> on behalf of myself, my youth or my family.
      <br><br>

      <select name="AbilityAdv" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - ABILITY TO ADVOCATE - with score of 2 or 3<br>
      <textarea form="mainForm" name="APAbilityAdv" rows="5" cols="80"></textarea>
      <br><br>

      <b>ABILITY TO PARTICIPATE IN PLANNING AND SUPPORT:</b> This item is asking you to identify any obstacles that
      interfere with your being involved in the services your youth is receiving or the plans that are being made.
      <br>
      (0) <purple>I/we am actively involved</purple> in the planning and/or implementation of services and I am able to overcome any
      obstacles that may be in the way.
      <br>
      (1) <purple>I/we am mostly involved</purple> in the planning and/or implementation of services for the youth but occasionally an
      obstacle will get in the way of participating.
      <br>
      (2) <purple>I/we am only somewhat or inconsistently involved</purple> in the planning an implementation of services.
      <br>
      (3) I/we am not currently involved</purple> with the plan of care for my youth.
      <br><br>

      <select name="AbilityPart" required>
        <option disabled selected>Select an option</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select><br><br>
      <b>ACTION PLAN</b> - ABILITY TO PARTICIPATE IN PLANNING AND SUPPORT - with score of 2 or 3<br>
      <textarea form="mainForm" name="APAbilityPart" rows="5" cols="80"></textarea>
      <br><br>

      <label for="NextFANDue">FAMILY LEVEL OF SERVICE:<purple>*</purple></label><br>
      <select name="FamService" required>
        <option disabled selected>Select an option</option>
        <option value="Supportive">Supportive</option>
        <option value="Moderate">Moderate</option>
        <option value="Intensive">Intensive</option>
      </select><br><br>
      <label for="NextFANDue">Next FAN Assesment Due Date:</label><br>
      <input type="date" name="NextFANDue"/><br>
      <label for="CreateDate">Created Date:<purple>*</purple></label><br>
      <input type="date" name="CreateDate" required/><br>
      <label for="SubmitDate">Assessment Submitted Date:<purple>*</purple></label><br>
      <input type="date" name="SubmitDate" required/><br><br>
	  <input type="file" id="myFile" name="filename"/><br><br>
      <input type="submit">
    </form>
    <script>
    function CalcTotalScore() {
      var formEl = document.forms.mainForm;
      var formData = new FormData(formEl);
      var AbilityPart = parseInt(formData.get('AbilityPart')=== null ? 0 : formData.get('AbilityPart'));
      var AbilityAdv = parseInt(formData.get('AbilityAdv')=== null ? 0 : formData.get('AbilityAdv'));
      var AbilityComm = parseInt(formData.get('AbilityComm')=== null ? 0 : formData.get('AbilityComm'));
      var KnowRight = parseInt(formData.get('KnowRight')=== null ? 0 : formData.get('KnowRight'));
      var KnowCommu = parseInt(formData.get('KnowCommu')=== null ? 0 : formData.get('KnowCommu'));
      var KnowCSOC = parseInt(formData.get('KnowCSOC')=== null ? 0 : formData.get('KnowCSOC'));
      var CareEff = parseInt(formData.get('CareEff')=== null ? 0 : formData.get('CareEff'));
      var CareStress = parseInt(formData.get('CareStress')=== null ? 0 : formData.get('CareStress'));
      var CareSelfCare = parseInt(formData.get('CareSelfCare')=== null ? 0 : formData.get('CareSelfCare'));
      var CareOrg = parseInt(formData.get('CareOrg')=== null ? 0 : formData.get('CareOrg'));
      var spirit = parseInt(formData.get('spirit')=== null ? 0 : formData.get('spirit'));
      var CareOpt = parseInt(formData.get('CareOpt')=== null ? 0 : formData.get('CareOpt'));
      var FamilySafty = parseInt(formData.get('FamilySafty')=== null ? 0 : formData.get('FamilySafty'));
      var FamilySocial = parseInt(formData.get('FamilySocial')=== null ? 0 : formData.get('FamilySocial'));
      var FamilyComm = parseInt(formData.get('FamilyComm')=== null ? 0 : formData.get('FamilyComm'));
      var CaregiverCollab = parseInt(formData.get('CaregiverCollab')=== null ? 0 : formData.get('CaregiverCollab'));
      var totalScore = AbilityPart+AbilityAdv+AbilityComm+KnowRight+KnowCommu+KnowCSOC+CareEff+CareStress+CareSelfCare+CareOrg+spirit+CareOpt+FamilySafty+FamilySocial+FamilyComm+CaregiverCollab;
      document.getElementById("totalScoreText").innerHTML = totalScore;
    }
    </script>
    Total Score:
    <p id="totalScoreText"></p><br>
    <button onclick="CalcTotalScore()">Calculate Score</button>
    </div>
  </body>
</html>


<?php


	if($_POST){

		$q = $db->prepare("DESCRIBE fans");
		$q->execute();
		$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);

    //post family to person
		$wat = $_POST['person'];
		unset($_POST['person']);
		#$_POST['family'] = $wat;

		#$wat1 = $table_fields['f_id'];
		#unset($table_fields['f_id']);
		#$table_fields['fid'] = $wat1;

		#array_push($_POST, );
		array_pop($table_fields);
		$table_fields[39] = 'fid'; //hmm



		$sql = 'INSERT INTO fans VALUES ( %s, DEFAULT)';

		$valuesClause = implode( ', ', array_map( function( $value ) { return ':' . $value; }, $table_fields ) );

		$sql = sprintf( $sql, $valuesClause );

		#var_dump($_FILES);

		#var_dump($table_fields);
		$counter = 0;
		$params = [];
		foreach ($_POST as $place => $other){
			$temp = ":";
			$temp .= $table_fields[$counter];
			$params[$temp] = $other;
			#echo $temp;
			$counter++;
		}

		$temp = ':';
		$temp .= "person_id"; //from fid
		$params[$temp] = $wat;
    $params[":fid"] = NULL; //...


		if(!empty($_FILES["filename"]["name"])){
			$filename = $_FILES['filename']['name'];
			$temp = explode(".", $_FILES["filename"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$destination = 'uploads/' . $filename;
			$file = $_FILES['filename']['tmp_name'];

			if ($_FILES['filename']['size'] > 500000) { // file shouldn't be larger than 500KB
				echo "File too large!";
			}

			elseif (move_uploaded_file($file, $destination . $newfilename)) {
				#echo ($destination . $newfilename);
				$stmt1 = $db->prepare("INSERT INTO `file_info` VALUES (?,?,?,DEFAULT)");
				$stmt1->execute([$filename, $newfilename, $destination . $newfilename]);
				#echo "<pre>" . var_export($stmt1->errorInfo(), true) . "</pre>";
				$params[':fan_file_id'] = intval($db->lastInsertId());
			}
		}

		else{
			$params[':fan_file_id'] = NULL;
		}
		#

		#var_dump($params);
		#var_dump($_POST);

		try{

			$stmt = $db->prepare($sql);

			//$stmt->execute($params);
    $result = $stmt->execute($params);
    verify_sql($stmt);
    if($result) {
      echo "<br>FANS submitted successfully";
      }
      else{
          echo "<br>FANS submission error";
      }

			#echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		}

		catch(Exception $e){
				echo $e->getMessage();
				exit();
		}
	}

?>
