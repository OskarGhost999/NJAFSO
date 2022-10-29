<?php
//login and register not functional with current database configuration

class DBL{

  private static function getDB(){
      global $common;
      if(isset($common)){
          return $common->getDB();
      }
      throw new Exception("Failed to find reference to common");
  }

  /** Wraps all responses in this wrapper as a contract for whoever calls this helper
    * @param $data
    * @param int $status
    * @param string $message
    * @return array
    */
  private static function response($data, $status = 200, $message = ""){
      return array("status"=>$status, "message"=>$message, "data"=>$data);
  }

  /*** Basic repetitive STMT check, throws exception
    * @param $stmt
    * @throws Exception
    */
  private static function verify_sql($stmt){
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
  
  public static function get_test(){
      try {
          $stmt = DBL::getDB()->prepare('SELECT * FROM test');
          $stmt->execute(); 
          DBL::verify_sql($stmt);
          #$stmt->execute(['uid' => intval($_SESSION["ID"])]);   # prior group code
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          #var_dump($results);
          #echo $results[0]["username"];

          if($result){
              return DBL::response($result,200, "success");
          }
          else{
              return DBL::response(NULL, 400, "error");
          }
      }
      catch(Exception $e){
          error_log($e->getMessage());
          return DBL::response(NULL, 400, "DB Error: " . $e->getMessage());
      }
  }

  public static function get_emp_id($username) {
    try {
      $query = "SELECT id FROM employees WHERE username = :username LIMIT 1";
      $stmt = DBL::getDB()->prepare($query);
      $stmt->execute([":username" => $username]);
      DBL::verify_sql($stmt);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($result) {
        return DBL::response($result, 200, "success");
      }
      else {
        return DBL::response(NULL, 400, "error");
      }
    }
    catch (Exception $e) {
      error_log($e->getMessage());
      return DBL::response(NULL, 400, "DB Error: " . $e->getMessage());

    }

  }
    // not functional atm
    public static function login($username, $pass){
      try {
          $query = "SELECT * FROM employees where username = :username LIMIT 1";
          $stmt = DBL::getDB()->prepare($query);
          $stmt->execute([":username" => $username]);
          DBL::verify_sql($stmt);
          $emp = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($emp) {
              if (password_verify($pass, $emp["password"])) {  
                  unset($emp["password"]);
                    $query = file_get_contents(__DIR__ . "/../sql/queries/get_roles.sql");
                    $stmt = DBL::getDB()->prepare($query);
                    $stmt->execute([":emp_id"=>$emp["id"]]);
                    DBL::verify_sql($stmt);
                    $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //error_log(var_export($roles, true));
                    $emp["roles"] = $roles;
                  return DBL::response($emp);
              } else {
                  return DBL::response(NULL, 403, "Invalid username or password");
              }
          } else {
              return DBL::response(NULL, 403, "Invalid username or password");
          }
      }
      catch(Exception $e){
          error_log($e->getMessage());
          return DBL::response(NULL, 400, "DB Error: " . $e->getMessage());
      }
  }
	// this could be with some small tweaks
  public static function register($firstName, $lastName, $username, $pass, $phoneNumber, $role, $fso){
    try {
        $query = file_get_contents(__DIR__ . "/../sql/queries/register.sql");
        $stmt = DBL::getDB()->prepare($query);
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        $result = $stmt->execute([
            ":first_name" => $firstName,
            ":last_name" => $lastName,
            ":username" => $username,
            ":password" => $pass,
            ":phone_number" => $phoneNumber,
            ":username" => $username,
            ":role_id" => $role,
            ":username" => $username,
            ":org_id" => $fso
        ]);
        DBL::verify_sql($stmt);
        if($result){
            return DBL::response(NULL,200, "Registration successful");
        }
        else{
            return DBL::response(NULL, 400, "Registration unsuccessful");
        }
    }
    catch(Exception $e){
        error_log($e->getMessage());
        return DBL::response(NULL, 400, "DB Error: " . $e->getMessage());
    }
}

  public static function submit_outMeet($date, $meetingType, $meetingLocation, $numPeople, $notes, $fso_id){
    try {
        //$query = file_get_contents(__DIR__ . "/../sql/queries/TBD.sql");
		$query = "INSERT INTO `outmeet` (fso_id, date, meeting_type, meeting_location, number_people, notes)
                    VALUES (:fso_id, :date, :meeting_type, :meeting_location, :number_people, :notes)";
        $stmt = DBL::getDB()->prepare($query);
        $result = $stmt->execute([
            ":fso_id" => $fso_id,
            ":date" => $date,
            ":meeting_type" => $meetingType,
            ":meeting_location" => $meetingLocation,
            ":number_people" => $numPeople,
            ":notes" => $notes,
        ]);
        DBL::verify_sql($stmt);
        if($result){
            return DBL::response(NULL,200, "Submitted successfully");
        }
        else{
            return DBL::response(NULL, 400, "Submission error");
        }
    }
    catch(Exception $e){
        error_log($e->getMessage());
        return DBL::response(NULL, 400, "DB Error: " . $e->getMessage());
    }
}


}