<?php
include_once "model/db/TableUser.class.php";

if (isset($_GET["id"])) {
  $tUser = new TableUser($db);
  $tUser->deleteById($_GET["id"]);
}

return include_once "controller/users.php";
?>