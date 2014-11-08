<?php
include_once "model/db/TableUser.class.php";
$tUser = new TableUser($db);

if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $usr = $tUser->getById($id);
  
  $out = include_once "view/admin/form-edit-user.php";
}
else if (isset($_POST["upd-user"])) {
  $id = $_POST["id"];
  $username = $_POST["username"];
  $pwd1 = $_POST["pwd1"];
  $pwd2 = $_POST["pwd2"];
  $email = $_POST["email"];
  $role = $_POST["role"];
  
  try {
    if ($pwd1 && $pwd2) {
      $tUser->changePassword($username, $pwd1, $pwd2);
    }
    $tUser->updateById($id, $role, $email);
    
    $usrMsg = "User '$username' updated";
    
    $out = include_once "controller/users.php";
  }
  catch(Exception $e) {
    $usrMsg = $e->getMessage();
    
    $usr = new stdClass();
    $usr->id_user = $id;
    $usr->username = $username;
    $usr->email = $email;
    $usr->role = $role;
    $out = include_once "view/admin/form-edit-user.php";
  }
}

return $out;
?>