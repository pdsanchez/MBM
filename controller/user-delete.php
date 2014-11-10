<?php
if ($user->isAdmin()) {
  include_once "model/db/TableUser.class.php";
  
  if (isset($_GET["id"])) {
    $tUser = new TableUser($db);
    $tUser->deleteById($_GET["id"]);
  }
  
  $out = include_once "controller/users.php";
}
else {
  $out = "Forbidden";
}
return $out;
?>