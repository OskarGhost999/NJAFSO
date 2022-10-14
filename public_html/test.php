<html>
 <body>
    <div class="col">
    <form class="form1" name="mainForm" id="mainForm" method="post" enctype="multipart/form-data">
	<input type="file" id="myFile" name="filename"/><br><br>
	<input type="submit">
    </form>
    </div>
  </body>
</html>

<?php session_start(); var_dump($_FILES); var_dump($_SESSION);?>