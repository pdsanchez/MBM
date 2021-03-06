<?php
include_once("model/db/TableUser.class.php");


$loginFormSubmitted = isset($_POST["login"]);
$loggingOut = isset($_POST["logout"]);

if ($loginFormSubmitted) {
  $username = $_POST["username"];
  $pwd = $_POST["pwd"];
  $userTable = new TableUser($db);
  try {
    $obj = $userTable->checkCredentials($username, $pwd);
    $user->login($obj);
    
    $log->info("LOGIN: $username - $obj->role");
  }
  catch(Exception $e) {}
}
else if($loggingOut) {
  $user->logout();
}
?>