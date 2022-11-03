<html lang="en" dir="ltr">
<style media="screen">
  purple{
    color: purple;
  }
</style>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <style>
    bh{
    font-weight: normal;
    margin-right: 10px;
    font-size: 30px;
    padding: 10px;
    font-family: 'Poppins', sans-serif;
    } 


    /* new stuff below */

#multi-step-form-container {
    margin-top: 5rem;
}
.text-center {
    text-align: center;
}
.mx-auto {
    margin-left: auto;
    margin-right: auto;
}
.pl-0 {
    padding-left: 0;
}
.button {
    padding: 0.7rem 1.5rem;
    border: 1px solid #005536;
    background-color: #04AA6D;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
}
.submit-btn {
    border: 1px solid #005536;
    background-color: #04AA6D;
}
.mt-3 {
    margin-top: 2rem;
}
.d-none {
    display: none;
}
.form-step {
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 20px;
    padding: 3rem;
    background-color: #fdc24b;
}
.font-normal {
    font-weight: normal;
}
ul.form-stepper {
    counter-reset: section;
    margin-bottom: 3rem;
}
ul.form-stepper .form-stepper-circle {
    position: relative;
}
ul.form-stepper .form-stepper-circle span {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateY(-50%) translateX(-50%);
}
.form-stepper-horizontal {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
ul.form-stepper > li:not(:last-of-type) {
    margin-bottom: 0.625rem;
    -webkit-transition: margin-bottom 0.4s;
    -o-transition: margin-bottom 0.4s;
    transition: margin-bottom 0.4s;
}
.form-stepper-horizontal > li:not(:last-of-type) {
    margin-bottom: 0 !important;
}
.form-stepper-horizontal li {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: start;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}
.form-stepper-horizontal li:not(:last-child):after {
    position: relative;
    -webkit-box-flex: 1;
    -ms-flex: 1;
    flex: 1;
    height: 1px;
    content: "";
    top: 32%;
}
.form-stepper-horizontal li:after {
    background-color: #dee2e6;
}
.form-stepper-horizontal li.form-stepper-completed:after {
    background-color: #0e954683;
}
.form-stepper-horizontal li:last-child {
    flex: unset;
}
ul.form-stepper li a .form-stepper-circle {
    display: inline-block;
    width: 40px;
    height: 40px;
    margin-right: 0;
    line-height: 1.7rem;
    text-align: center;
    background: rgba(0, 0, 0, 0.38);
    border-radius: 50%;
}
.form-stepper .form-stepper-active .form-stepper-circle {
    background-color: #04AA6D !important;
    color: #fff;
}
.form-stepper .form-stepper-active .label {
    color: black !important;
}
.form-stepper .form-stepper-active .form-stepper-circle:hover {
    background-color: #04AA6D !important;
    color: #fff !important;
}
.form-stepper .form-stepper-unfinished .form-stepper-circle {
    background-color: #f8f7ff;
}
.form-stepper .form-stepper-completed .form-stepper-circle {
    background-color: #0e954683 !important;
    color: #fff;
}
.form-stepper .form-stepper-completed .label {
    color: #0e954683 !important;
}
.form-stepper .form-stepper-completed .form-stepper-circle:hover {
    background-color: #0e954683 !important;
    color: #fff !important;
}
.form-stepper .form-stepper-active span.text-muted {
    color: #fff !important;
}
.form-stepper .form-stepper-completed span.text-muted {
    color: #fff !important;
}
.form-stepper .label {
    font-size: 1rem;
    margin-top: 0.5rem;
}
.form-stepper a {
    cursor: default;
}

#multi-step-form-container {
    margin: 10px;
    padding-left: 20px;
    padding-right: 20px;
}

* {
  box-sizing: border-box;
}

input[type=text], [type=tel], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

.date {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
    margin-left: 550px;
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 50px;
}

.col-25 {
  float: left;
  width: 10%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 90%;
  margin-top: 6px;
}

/* clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

option {
    margin:100px;
}

  </style>
  <meta charset="utf-8">
  <title>Youth Partnership Intake</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/jumbotron/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
 
<?php
    include_once('navbar.php');
?>
<body> <!-- entire body is new code with pagination with the old form -->
      <div>
         <div class="lead text-center">
        <h1 class="display-4">Youth Partnership Intake</h1>
   	 </div>
        <div id="multi-step-form-container">
            <!-- form steps / progress Bar -->
            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                <!-- step 1 -->
                <li class="form-stepper-active text-center form-stepper-list" step="1">
                    <a class="mx-2">
                        <span class="form-stepper-circle">
                            <span>1</span>
                        </span>
                        <div class="label">General Information</div>
                    </a>
                </li>
                <!-- step 2 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>2</span>
                        </span>
                        <div class="label text-muted">Contacts</div>
                    </a>
                </li>
                <!-- step 3 -->
                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                    <a class="mx-2">
                        <span class="form-stepper-circle text-muted">
                            <span>3</span>
                        </span>
                        <div class="label text-muted">Personal Details</div>
                    </a>
                </li>
            </ul>
            <!-- step form content -->
            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">
                <!-- step 1 content -->
                <section id="step-1" class="form-step">
                    <h2 class="font-normal">General Information</h2>
                    <!-- step 1 input fields -->
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-25">
                              <label for="firstName">First Name</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="firstName" name="firstName" placeholder="Enter the youth's first name"/ required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-25">
                              <label for="lastName">Last Name</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="lastName" name="lastName" placeholder="Enter the youth's last name"/ required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-25">
                              <label for="adress">Address</label>
                            </div>
                            <div class="col-75">
								<input type="text" name="street" id="street" placeholder="Street"><br>
								<input type="text" name="inputCity" id="inputCity" placeholder="City"><br>
								<input type="text" name="inputState" id="inputState" placeholder="State"><br>
								<input type="text" name="inputZip" id="inputZip" placeholder="Zip"><br>
								<input type="text" name="inputCounty" id="inputCounty" placeholder="County">
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                              <label for="email">Email</label>
                            </div>
                            <div class="col-75">
                              <input type="email" id="email" name="email" class="date" placeholder="Enter the youth's email">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-25">
                              <label for="dob">Date of Birth</label>
                            </div>
                            <div class="col-75">
                              <input type="date" id="DOB" name="DOB" class="date" placeholder="mm/dd/yyyy" required>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-25">
                              <label for="homePhone">Home Phone Number</label>
                            </div>
                            <div class="col-75">
                              <input type="tel" id="homePhone" name="homePhone" placeholder="Enter the youth's home phone number">
                            </div>
                          </div>

						  <div class="row">
                            <div class="col-25">
                              <label for="cellPhone">Cellphone Number</label>
                            </div>
                            <div class="col-75">
                              <input type="tel" id="cellPhone" name="cellPhone" placeholder="Enter the youth's cell phone number">
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-25">
                              <label for="CMOServices">Receiving CMO services?</label>
                            </div>
                            <div class="col-75">
                                <select id="CMOServices" name="CMOServices">
                                    <option disabled selected>Select an option</option>
                                  <option value="yes">Yes</option>
                                  <option value="no">No</option>
                                </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-25">
                              <label for="education">Education</label>
                            </div>
                            <div class="col-75">
                                <select id="Education[]" name="Education[]">
                                  <option disabled selected>Select education level</option>
                                  <option value="Elementary">Elementary School</option>
                                  <option value="Middle">Middle School</option>
                                  <option value="High">High School</option>
                                  <option value="College">College</option>
                                  <option value="No College">No college</option>
                                </select>
                            </div>
                          </div>


					

						  		  <div class="row">
                            <div class="col-25">
                              <label for="gradelevel">Grade level</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="cellPhone" name="cellPhone" placeholder="Enter the youth's cell phone number">
                            </div>
                          </div>


						  		  <div class="row">
                            <div class="col-25">
                              <label for="School Name">School Name</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="SchoolName" name="SchoolName" placeholder="Enter the youth's school name.">
                            </div>
                          </div>



						    <div class="row">
                            <div class="col-25">
                              <label for="schoolAddress">School Address</label>
                            </div>
                            <div class="col-75">
								<input type="text" name="Schoolstreet" id="Schoolstreet" placeholder="Street"><br>
								<input type="text" name="Schoolcity" id="Schoolcity" placeholder="City"><br>
								<input type="text" name="Schoolstate" id="Schoolstate" placeholder="State"><br>
								<input type="text" name="Schoolzip" id="Schoolzip" placeholder="Zip"><br>
								<input type="text" name="Schoolcounty" id="Schoolcounty" placeholder="County">
                            </div>
                          </div>

						      <div class="row">
                            <div class="col-25">
                              <label for="Health Information">Health Information</label>
                            </div>
                            <div class="col-75">
								  
								  <br>
								  <input type="checkbox" name="Health[]" value="Allergic to peanuts"> Allergic to peanuts</input>
									<br>
									<input type="checkbox" name="Health[]" value="Allergic to Bee Stings"> Allergic to Bee Stings</input>
									<br>
									<input type="checkbox" name="Health[]" value="Asthma"> Asthma</input>
									<br>
									<input type="checkbox" name="Health[]" value="Developmental of learning disabilities"> Developmental of learning disabilities</input>
									<br>
									<input type="checkbox" name="Health[]" value="Diabetes"> Diabetes</input>
									<br>
									<input type="checkbox" name="Health[]" value="Taking medications regularly"> Taking medications regularly</input>
									<br>
									<label for="Other Allergy/Health Concern">Other Allergy/Health Concern:</label><br>
									<textarea form="mainForm" name="Health[]" rows="5" cols="80"></textarea>
								</div>
                          </div>



                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                    </div>
                </section>
                <!-- step 2 content, default hidden on page load -->
                <section id="step-2" class="form-step d-none">
                    <h2 class="font-normal">Contacts</h2>
                    <!-- step 2 input fields -->
                    <div class="mt-3">
                        

						<div class = "row"> 
						<h4 class="font-normal">Parent or Caregiver Contact Information</h4>
						</div>

							<div class="row">
                            <div class="col-25">
                              <label for="Relationship">Relationship</label>
                            </div>
                            <div class="col-75">
                              
								  <select name="Relationship">
								  <option disabled selected>--Select--</option>
									<option value="PrimaryCaregiver">Primary Caregiver</option>
									<option value="Sibling">Sibling</option>
									<option value="OtherAdultReletive">Other Adult Reletive</option>
									<option value="CommunityMember">Community Member</option>
									<option value="Other">Other</option>
								  </select>
							</div>
							</div>
		
		
							<div class="row">
                            <div class="col-25">
                              
								  <label for="ParentfirstName">First Name:</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="ParentfirstName" name="ParentfirstName" placeholder="First Name"/>
							</div>
							</div>

							
							<div class="row">
                            <div class="col-25">
                               <label for="ParentLastName">Last Name:</label>
                            </div>
                            <div class="col-75">
                              <input type="text" id="ParentLastName" name="ParentLastName" placeholder="Last Name"/>
							</div>
							</div>




							
							<div class="row">
                            <div class="col-25">
                              	  <label for="ParentPhone">Phone Number:</label>
                            </div>
                            <div class="col-75">
                              <input type="tel" id="ParentPhone" name="ParentPhone" placeholder="Phone Number"/><br>

							</div>
							</div>


		


							<div class="row">
                            <div class="col-25">
									<label for="parentAddress">Address</label>
                            </div>
                            <div class="col-75">
                              <input type="text" name="Parentstreet" placeholder="Street"><br>
									<input type="text" name="Parentcity" placeholder="City"><br>
									<input type="text" name="Parentstate" placeholder="State"><br>
									<input type="text" name="Parentzip" placeholder="Zip"><br>
									<input type="text" name="Parentcounty" placeholder="County">
							</div>
							</div>

							<br>
							<div class="row">
							<h4 class="font-normal">Emergency Contact Information</h4>
							</div>
							<br>


								<div class="row">
							<h5 class="font-normal">Emergency Contact 1</h4>
							</div>

							
							
							<div class="row">
                            <div class="col-25">
                              <label for="Emergency Contact 1 Name">Name:</label>
                            </div>
                            <div class="col-75">
                                    
								<input type="text" id="Emergency Contact 1 Name" name="EmergencyName"/><br>
							</div>
							</div>


							
							<div class="row">
                            <div class="col-25">
                            <label for="homePhone">Phone:</label>
                            </div>
                            <div class="col-75">
                                 <input type="tel" id="Emergency Contact 1 Phone" name="EmergencyPhone"><br>
							</div>
							</div>


							
							<div class="row">
                            <div class="col-25">
                             <label for="Emergency Contact 1 Relationship">Relationship:</label>
                            </div>
                            <div class="col-75">
                                  <input type="text" name="EmergencyRelationship">
							</div>
							</div>

						





							<br>
							<div class="row">
							<h5 class="font-normal">Emergency Contact 2</h4>
							</div>


							<div class="row">
                            <div class="col-25">
                              <label for="Emergency Contact 2 Name">Name:</label>
                            </div>
                            <div class="col-75">
                                    
								<input type="text" id="Emergency Contact 2 Name" name="EmergencyName2"/><br>
							</div>
							</div>


							
							<div class="row">
                            <div class="col-25">
                            <label for="homePhone">Phone:</label>
                            </div>
                            <div class="col-75">
                                 <input type="tel" id="Emergency Contact 2 Phone" name="EmergencyPhone2"><br>
							</div>
							</div>


							
							<div class="row">
                            <div class="col-25">
                             <label for="Emergency Contact 1 Relationship">Relationship:</label>
                            </div>
                            <div class="col-75">
                                  <input type="text" name="EmergencyRelationship2">
							</div>
							</div>

						


                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                        <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                    </div>
                </section>
                <!-- step 3 content, default hidden on page load -->
                <section id="step-3" class="form-step d-none">
                    <h2 class="font-normal">Personal Details</h2>
                    <!-- step 3 input fields -->
                    <div class="mt-3">
                        
					 <div class="row">
                            <div class="col-25">
                              <label for="Personal Goals">Personal Goals</label>
                            </div>
                            <div class="col-75">
							<br>
                             <input type="checkbox" name="LifeGoals[]" value="Place to live"> Place to live</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Improving self-esteem"> Improving self-esteem</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Anger Management"> Anger Management</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Learning something new"> Learning something new</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Making friends"> Making friends</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Social Skills"> Social Skills</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Developing a positive attitude"> Developing a positive attitude</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Be more vocal in becoming an advocate"> Be more vocal in becoming an advocate</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Bring up grades"> Bring up grades</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Participate in School activities"> Participate in School activities</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Get a job"> Get a job</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Participate in activities outside of school"> Participate in activities outside of school</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Give back to my community"> Give back to my community</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Develop leadership skills"> Develop leadership skills</input>
							  <br>
							  <input type="checkbox" name="LifeGoals[]" value="Improve communication skills"> Improve communication skills</input>
							  <br>
							  <label for="Other Goals">Other Goals:</label><br>
							  <textarea form="mainForm" name="LifeGoals[]" rows="5" cols="80"></textarea>

						   
						   
						   </div>
                          </div>


						  	 <div class="row">
                            <div class="col-25">
                              <label for="Future Aspirations">Future Aspirations</label>
                            </div>
                            <div class="col-75">
                              
							    
							  
							  <input type="text" name="CareerofInterest1" placeholder="First Career of Interest"/>
							  <br>
							  
							  <input type="text" name="CareerofInterest2"placeholder="Second Career of Interest"/>
							  <br>
							  
							  </div>
                          </div>


						  <div class="row">
                            <div class="col-25">
                              <label for="Learning Interests">Learning Interests</label>
                            </div>
                            <div class="col-75">

							<br>
                              <input type="checkbox" name="LearningInterests[]" value="Microsoft Word"> Microsoft Word</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Microsoft Excel"> Microsoft Excel</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Microsoft Powerpoint"> Microsoft Powerpoint</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Microsoft Publisher"> Microsoft Publisher</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Public Speaking"> Public Speaking</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Fundraising"> Fundraising</input>
							  <br>
							  <input type="checkbox" name="LearningInterests[]" value="Publishing"> Publishing</input>
							  <br>
							  <label for="Other Learning Interests">Other Learning Interests:</label><br>
							  <textarea form="mainForm" name="LearningInterests[]" rows="5" cols="80"></textarea>
                            </div>
                          </div>

						  						  		  <div class="row">
                            <div class="col-25">
                              <label for="General Interests">General Interests</label>
                            </div>
                            <div class="col-75">
									<br>
							       <input type="checkbox" name="GeneralInterests[]" value="Art"> Art</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Drama/Theater Arts"> Drama/Theater Arts</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Sports"> Sports</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Dance"> Dance</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Music"> Music</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Writing"> Writing</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Reading"> Reading</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Hanging out with friends"> Hanging out with friends</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Technology"> Technology</input>
								  <br>
								  <input type="checkbox" name="GeneralInterests[]" value="Community Service"> Community Service</input>
								  <br>
								  <label for="Other General Intrests">Other General Interests:</label><br>
								  <textarea form="mainForm" name="GeneralInterests[]" rows="5" cols="80"></textarea>
								  <br>
							 
							 </div>
                          </div>




                    </div>
                    <div class="mt-3">
                        <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                        <button class="button submit-btn" type="submit">Submit</button>
                    </div>
                </section>
            </form>
        </div>
    </div>
    <script src="pagination.js"></script>



  </body>
</html>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

require("config.php");

if(!(isset($_SESSION['role']))){
  header("Location: index.php");
}
	if(!($_SESSION['role']>=0)){
	header("Location: index.php");
}

$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";

if($_POST){
	
	$db = new PDO($connection_string, $dbuser, $dbpass);
	
	//var_dump($_POST);
	//var_dump($_POST["firstName"]);
	
	$q = $db->prepare("DESCRIBE fans");
	$q->execute();
	$table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
	array_pop($table_fields);
	

	try{
		$db = new PDO($connection_string, $dbuser, $dbpass);
		
		#Youth info
		$stmt = $db->prepare("INSERT INTO `personal_info`
                        VALUES (:firstname, :lastname, :prefix, :middlename, :gender, :dob, :race, 
						:home_phone,:cell_phone, :email, DEFAULT)");

		$params = array(":firstname"=> $_POST["firstName"],":lastname"=> $_POST["lastName"], ":prefix"=> NULL,
						":middlename"=> NULL,":email"=> $_POST["email"], ":dob"=> $_POST["DOB"], 
						":gender"=> NULL, ":race"=> NULL, ":home_phone"=>$_POST["homePhone"], ":cell_phone"=>$_POST["cellPhone"]);
						
		$stmt->execute($params);
						
		$youth_id = intval($db->lastInsertId());
		
    echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>"; #added error checking.
    #Parent Info
		
		$stmt = $db->prepare("INSERT INTO `personal_info`
                        VALUES (:firstname, :lastname, :prefix, :middlename, :gender, :dob, :race, 
						:home_phone,:cell_phone, :email, DEFAULT)");

		$params = array(":firstname"=> $_POST["ParentfirstName"],":lastname"=> $_POST["ParentLastName"], ":prefix"=> NULL,
						":middlename"=> NULL,":email"=> $_POST["ParentEmail"], ":dob"=> NULL, 
						":gender"=> NULL, ":race"=> NULL, ":home_phone"=>NULL, ":cell_phone"=>$_POST["ParentPhone"]);
						
		$stmt->execute($params);
						
		$parent_id = intval($db->lastInsertId());
		
		#Youth Address
		
		$address1 = $_POST["street"] . " " . $_POST["inputCity"] . " " . $_POST["inputState"];
		
		$stmt = $db->prepare("INSERT INTO `address`
                        VALUES (:address1, :address2, :zip, :county, DEFAULT)");

		$params = array(":address1"=> $address1, ":address2"=> NULL, ":zip"=> $_POST["inputZip"],":county"=> $_POST["inputCounty"]);
						
		$stmt->execute($params);
						
		$youth_addr = intval($db->lastInsertId());
		
		#School Address
		
		$address1 = $_POST["Schoolstreet"] . " " . $_POST["Schoolcity"] . " " . $_POST["Schoolstate"];
		
		$stmt = $db->prepare("INSERT INTO `address`
                        VALUES (:address1, :address2, :zip, :county, DEFAULT)");

		$params = array(":address1"=> $address1, ":address2"=> NULL, ":zip"=> $_POST["Schoolzip"],":county"=> $_POST["Schoolcounty"]);
						
		$stmt->execute($params);
						
		$shool_addr = intval($db->lastInsertId());
		
		#Parent Address
		
		$address1 = $_POST["Parentstreet"] . " " . $_POST["Parentcity"] . " " . $_POST["Parentstate"];
		
		$stmt = $db->prepare("INSERT INTO `address`
                        VALUES (:address1, :address2, :zip, :county, DEFAULT)");

		$params = array(":address1"=> $address1, ":address2"=> NULL, ":zip"=> $_POST["Parentzip"],":county"=> $_POST["Parentcounty"]);
						
		$stmt->execute($params);
						
		$parent_addr = intval($db->lastInsertId());
		
		#----------------------------
		
		if ($_POST["Education"]){
			$education_str = implode (", ", $_POST["Education"]);
			}

			else{
				$education_str = NULL;
			}
		if ($_POST["Health"]){
			$Health_str = implode (", ", $_POST["Health"]);
			}

			else{
				$Health_str = NULL;
			}
		if ($_POST["LifeGoals"]){
			$life_str = implode (", ", $_POST["LifeGoals"]);
			}

			else{
				$life_str = NULL;
			}
		if ($_POST["LearningInterests"]){
			$learning_str = implode (", ", $_POST["LearningInterests"]);
			}

			else{
				$learning_str = NULL;
			}
			
		if ($_POST["GeneralInterests"]){
			$general_str = implode (", ", $_POST["GeneralInterests"]);
			}

			else{
				$general_str = NULL;
			}
		var_dump($_POST);
		$stmt = $db->prepare("INSERT INTO `youth_intake`
                        VALUES (:cmo_option, :education_level,:grade,:school_name, :health_name, :parent_relationship, :personal_goals, :first_career,
						:second_career,:learning_intrests,:general_intrests, :youth_address ,:school_address,:parent_address,
						:youth_person, :parent_person, :u_id, DEFAULT)");
								
		$params = array(":cmo_option"=> $_POST["CMOServices"],":education_level"=> $education_str, ":grade"=> $_POST["Grade"],
						":school_name"=> $_POST["SchoolName"], ":health_name"=> $Health_str, ":parent_relationship"=> $_POST["Relationship"], 
						":personal_goals"=> $life_str, ":first_career"=> $_POST["CareerofInterest1"], ":second_career"=> $_POST["CareerofInterest2"],
						":learning_intrests"=> $learning_str,":general_intrests"=> $general_str, ":youth_address"=> $youth_addr, ":school_address"=> $shool_addr,
						":parent_address"=> $parent_addr, ":youth_person"=> $youth_id, ":parent_person"=> $parent_id, ":u_id"=>intval($_SESSION["ID"]) );
		
		$stmt->execute($params);
		echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
		$id = intval($db->lastInsertId());

		$stmt1 = $db->prepare("INSERT INTO `emergency_contact` VALUES (:name, :phone, :Relationship, :youth_id, DEFAULT)");

		$params1 = array(":name"=> $_POST["EmergencyName"],":phone"=> $_POST["EmergencyPhone"],":Relationship"=> $_POST["EmergencyRelationship"],
						":youth_id"=> $id);
		$stmt1->execute($params1);
		
		if($_POST["EmergencyName"]){
			$stmt1 = $db->prepare("INSERT INTO `emergency_contact` VALUES (:name, :phone, :Relationship, :youth_id, DEFAULT)");

			$params1 = array(":name"=> $_POST["EmergencyName2"],":phone"=> $_POST["EmergencyPhone2"],":Relationship"=> $_POST["EmergencyRelationship2"],
							":youth_id"=> $id);
			$stmt1->execute($params1);
		}



		#var_dump($id);
        #echo "<pre>" . var_export($stmt1->errorInfo(), true) . "</pre>";
        }
        catch(Exception $e){
                echo $e->getMessage();
                exit();
        }
	}
