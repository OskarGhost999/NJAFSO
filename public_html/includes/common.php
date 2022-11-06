<?php
//session_start();
//ini_set('display_errors',1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

class Common {
  private $db;

  public function getDB() {
  if (!isset($this->db)) {
      //Initialize all of these at once to make IDE happy
      $dbdatabase = $dbuser = $dbpass = $dbhost = NULL;
      require_once(__DIR__ . "/config.php");
      if (isset($dbhost) && isset($dbdatabase) && isset($dbpass) && isset($dbuser)) {
          $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
          $this->db = new PDO($connection_string, $dbuser, $dbpass);
      } else {
          //https://www.w3schools.com/php/func_error_log.asp
          error_log("Missing db config details");
          }
      }
  return $this->db;
  }

  public static function get($arr, $key, $default = "") {
  if (is_array($arr) && isset($arr[$key])) {
      return $arr[$key];
  }
  return $default;
  }

  public static function flash($message, $type = "info") {
  if (!isset($_SESSION["messages"])) {
      $_SESSION["messages"] = [];
  }
  array_push($_SESSION["messages"], ["message"=>$message, "type"=>$type]);
  //error_log(var_export($_SESSION["messages"], true));
  }

  public static function getFlashMessages() {
  $messages = $_SESSION["messages"];
  //error_log("Get Flash Messages(): " . var_export($messages, true));
  $_SESSION["messages"] = [];
  return $messages;
  }

  public static function get_user_id(){
    $id = -1;
    $user = Common::get($_SESSION, "user", false);
    if($user){
        $id = Common::get($user,"id", -1);
    }
    return $id;
  }
    // WIP
	public static function has_role($role){
	$user = Common::get($_SESSION, "user", false);
	if($user){
		$roles = Common::get($user, "roles", []);
		foreach($roles as $r){
			if($r["name"] == $role){ 
				return true;
			}
		}
	}
	return false;
    }

    public static function build_table($array){

        $html = '<table>';

        $html .= '<tr>';
        foreach($array[0] as $key=>$value){
                $col_name = ucwords(str_replace("_"," ",$key));
                $html .= '<th>' . htmlspecialchars($col_name) . '</th>';
            }
        $html .= '</tr>';

        foreach( $array as $key=>$value){
            $html .= '<tr>';
            foreach($value as $key2=>$value2){
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
            $html .= '</tr>';
        }

        $html .= '</table>';
        return $html;
    }

}
$common = new Common();
//make sure this is after we init common so it has access to it
require_once (__DIR__."/db_lib.php");