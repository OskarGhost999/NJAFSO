<?php
//login and register not functional with this configuration

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

  // from staging 5 rip
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

    public static function login($username, $pass){
      try {
          $query = "SELECT * FROM employees where username = :username LIMIT 1";
          $stmt = DBL::getDB()->prepare($query);
          $stmt->execute([":username" => $username]);
          DBL::verify_sql($stmt);
          $emp = $stmt->fetch(PDO::FETCH_ASSOC);
          if ($emp) {
              if (true) { #(password_verify($pass, $emp["password"])) {  //need to hash admin password before uncommenting
                  unset($emp["password"]);//TODO remove password before we return results -- CHECK
                  //TODO get roles
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

  public static function save_address($address1, $address2, $city, $zip, $county) {
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/insert_address.sql");
            $db = DBL::getDB();
            $stmt = $db->prepare($query);
            $result = $stmt->execute([
                ":address1" => $address1,
                ":address2" => $address2,
                ":city" => $city,
                ":zip" => $zip,
                ":county" => $county
            ]);
            DBL::verify_sql($stmt);
            if($result){
                $address_id = intval($db->lastInsertId());
                return DBL::response($address_id, 200, "Submitted successfully");
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

	//..
  public static function save_personal_info($firstname, $lastname, $prefix, $middlename, $dob, $gender, $race,
											$home_phone, $email, $maritalstatus, $referred, $familymemberrole,
											$primarylanguage, $otherlanguage, $childrenreceivingservices, $address_id, $user_id) {
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/insert_personal_info.sql");
            $db = DBL::getDB();
            $stmt = $db->prepare($query);
            $result = $stmt->execute([
				":firstname"=> $firstname,
				":lastname"=> $lastname, 
				":prefix"=> $prefix,
				":middlename"=> $middlename,
				":dob"=> $dob, 
				":gender"=> $gender, 
				":race"=> $race, 
				":home_phone"=>$home_phone, 
				":email"=> $email, 
				":maritalstatus"=> $maritalstatus, 
				":referred"=> $referred,
				":familymemberrole"=> $familymemberrole, 
				":primarylanguage"=> $primarylanguage, 
				":otherlanguage"=> $otherlanguage,
				":childrenreceivingservices"=> $childrenreceivingservices,
				":address_id" => $address_id,
				":user_id" => $user_id
            ]);
            DBL::verify_sql($stmt);
            if($result){
                $person_id = intval($db->lastInsertId());
                return DBL::response($person_id, 200, "Submitted successfully");
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

  public static function save_case($startdate, $casenumber, $caremanager, $dyfscontact, $person_id) {
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/insert_case.sql");
            $db = DBL::getDB();
            $stmt = $db->prepare($query);
            $result = $stmt->execute([
                ":programstartdate" => $startdate,
                ":casenumber" => $casenumber,
                ":caremanager" => $caremanager,
                ":dyfscontact" => $dyfscontact,
                ":person_id" => $person_id
            ]);
            DBL::verify_sql($stmt);
            if($result){
                return DBL::response(NULL, 200, "Submitted successfully");
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

  public static function save_cmo_record($cyberNumber, $childsLevelofCare, $childsPlacement, $child_str, $childEnrollmentDate,
                                            $CMODischargeDate, $CMODischargeStatus, $dcpp, $courtInvolvement, $person_id) {
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/insert_cmo_record.sql");
            $db = DBL::getDB();
            $stmt = $db->prepare($query);
            $result = $stmt->execute([
                ":cybernumber" => $cyberNumber,
                ":childlevelcare" => $childsLevelofCare,
                ":childplacement" => $childsPlacement,
                ":childDiagnosis" => $child_str,
                ":childenrollmentedate" => $childEnrollmentDate,
                ":cmodischargedate" => $CMODischargeDate,
                ":cmostatus" => $CMODischargeStatus,
                ":dcppinvolvement" => $dcpp,
                ":courtinvolvement" => $courtInvolvement,
                ":person_id"=> $person_id 
            ]);
            DBL::verify_sql($stmt);
            if($result){
                return DBL::response(NULL, 200, "Submitted successfully");
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

    public static function get_family_info($family_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_family_info.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":fid" => $family_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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
    // make this more modular
    public static function get_address($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_address.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    public static function get_case($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_case.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    public static function get_progress_notes($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_progress_notes.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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
    
    public static function get_fans($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_fans.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    // try to merge these two
    public static function get_progress_files($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_progress_files.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    public static function get_fans_files($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_fans_files.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    public static function get_intake_records($person_id){
        try {
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_fans_files.sql");
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":id" => $person_id]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

    public static function get_all_family_intake_records($search, $post_sort) {
        try {
			$sort = $post_sort;
            $mapped_col = " person_id ASC"; 	//default to id
            if($sort == "lastname DESC"){
                $mapped_col = " lastname DESC";
            }
            else if($sort == "lastname ASC"){
                $mapped_col = " lastname ASC";
            }
            else if($sort == "programstartdate DESC"){
                $mapped_col = " programstartdate DESC";
            }
            else if($sort == "programstartdate ASC"){
                $mapped_col = " programstartdate ASC";
            }
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_all_family_intake_records.sql");
			$query .= $mapped_col;
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":search"=>$search]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

	public static function get_all_progress_notes($search, $post_sort){
        try {
			$sort = $post_sort;
            $mapped_col = " id ASC"; 	//default to id
            if($sort == "lastname DESC"){
                $mapped_col = " lastname DESC";
            }
            else if($sort == "lastname ASC"){
                $mapped_col = " lastname ASC";
            }
            else if($sort == "note_date DESC"){
                $mapped_col = " note_date DESC";
            }
            else if($sort == "note_date ASC"){
                $mapped_col = " note_date ASC";
            }
            $query = file_get_contents(__DIR__ . "/../sql/queries/get_all_family_progress_notes.sql");
			$query .= $mapped_col;
            $stmt = DBL::getDB()->prepare($query);
            $result = $stmt->execute([":search"=>$search]);
            DBL::verify_sql($stmt);
            if($result){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return DBL::response($result, 200, "success");
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

}