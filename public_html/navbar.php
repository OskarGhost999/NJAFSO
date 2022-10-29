<?php
require_once (__DIR__."/includes/common.php"); 
?>

<style>
  hotbox{
    border-radius:20px;
  }
  hotbox:hover{
    transition: .25s;
    background-color:black;
  }
  .button {
      padding: 7px 14px;
      text-align: center;
      display: inline-block;
      font-size: 16px;
  }
  body{
      background-color: #e0f5f5;
  }
  .heart
  {
    position:absolute;
    top: -153px;
    left: -33px;
    width:50px;
    height:150px;
    margin:175px;
    opacity:.8;
  }
  
  .heart:before,.heart:after
  {
    position: absolute;
    content: "";
    width: 20px;
    height:32px;
    background :white;
    border-radius:50px 50px 0 0;
    margin-left: .5rem !important;
    margin-right: .5rem !important;
  }
  .heart:before{
    left:30px;
    -webkit-transform-rotate(-45deg);
    transform:rotate(-45deg);
    -webkit-transform-origin:0 100%;
    transform:origin:0 100%;
  }
  .heart:after{
    left: 16px;
    top: -14px;
    -webkit-transform-rotate(45deg);
    transform:rotate(45deg);
    -webkit-transform-origin:0 100%;
    transform:origin:100% 100%;
  }

</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-light" style="font-family: sans-serif; font-size: 120%; background-color: #36096d; background-image: linear-gradient(315deg, #0077b6 20%, #FFAA00 75%);">

  <a class="navbar-brand" href="home.php" style ="font-size: 35px; margin-right: 3rem; font-family: 'Poppins', sans-serif; "><b>NJAFSO</b></a>
  <div class="heart"></div>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarsExampleDefault" aria-expanded="true" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">


    <ul class="navbar-nav mr-auto">
      <hotbox>
      <li class="nav-item">
        <a class="nav-link" href="warmline.php" style="color:white;">Warmline Contact</a>
      </li>
      </hotbox>
      <hotbox>
        <li class="nav-item dropdown">
          
          <a class="nav-link dropdown-toggle" style="color:white;" id="navbarDropdown" role="button" data-toggle="dropdown">
            Community Outreach
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="out-Meet.php">FSO-Meeting and Training Attendance</a>
            <a class="dropdown-item" href="InitMeet.php">Assigned FSO Meetings</a>
            <a class="dropdown-item" href="CommMeet.php"> Community Initiatives and Meetings provided by FSO</a>
          </div>
        </li>
      </hotbox>
      <hotbox>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:white;" id="navbarDropdown" role="button" data-toggle="dropdown">
            Family Support
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="intake.php">Participant Enrollment</a>
            <a class="dropdown-item" href="InitMeet.php">Assigned FSO Meetings</a>
            <a class="dropdown-item" href="FANAssesment.php">FANS Assesment</a>
            <a class="dropdown-item" href="Satisfaction-Survey.php">Family Satisfaction Survey</a>
            <a class="dropdown-item" href="prognotes.php">Family Progress Notes</a>
          </div>

        </li>
      </hotbox>
      <hotbox>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color:white;" id="navbarDropdown" role="button" data-toggle="dropdown">
              Youth Partnership
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="Youth-Partnership-Inake.php">Youth Partnership Intake</a>
            <a class="dropdown-item" href="Youth-Partnership-Meeting.php">Youth Partnership Meeting</a>
            <a class="dropdown-item" href="Youth-Partnership-Task.php">Youth Partnership Task</a>
          </div>

        </li>

    </ul>
     
      <button style="float:right" type="button" class="btn btn-dark" onclick="location.href = 'home.php';">Return to Home</button>
	  <button style="float:right" type="button" class="btn btn-dark" onclick="location.href = 'logout.php';">Logout</button>


  </div>
  </nav>
  <div id="messages">
  <?php $flash_messages = Common::getFlashMessages();?>
  <?php if(isset($flash_messages) && count($flash_messages) > 0):?>
    <?php foreach($flash_messages as $msg):?>
        <div class="alert alert-<?php echo Common::get($msg, "type");?>"><?php
            echo Common::get($msg, "message");
            ?></div>
    <?php endforeach;?>
  <?php endif;?>  
</header>