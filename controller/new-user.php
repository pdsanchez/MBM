<?php
include_once("model/db/TableUser.class.php");

$createNewUser = isset($_POST["new-user"]);
if ($createNewUser) {
  $newName = $_POST["username"];
  $newPwd = $_POST["pwd"];
  $newEmail =$_POST["email"];
  $newRole = $_POST["role"];
  $userTable = new TableUser($db);
  try {
    $userTable->create($newName, $newPwd, $newRole, $newEmail);
    $adminFormMsg = "New user created for $newEmail";
  }
  catch(Exception $e) {
    $adminFormMsg = $e->getMessage();
  }
}

$newAdminForm = include_once("view/form-new-user.php");
return $newAdminForm;
?>