<?php
include_once "model/db/TableUser.class.php";

if (isset($_POST["new-user"])) {
  $newName = $_POST["username"];
  $newPwd = $_POST["pwd"];
  $newEmail =$_POST["email"];
  $newRole = $_POST["role"];
  $userTable = new TableUser($db);
  try {
    $userTable->create($newName, $newPwd, $newRole, $newEmail);
    $usrMsg = "New user created for $newEmail";
  }
  catch(Exception $e) {
    $usrMsg = $e->getMessage();
  }
  
  $out = include_once "controller/users.php";
}
else {
  $out = include_once "view/form-new-user.php";
}

return $out;
?>