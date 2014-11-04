<?php
if ($user->isAdmin()) {
  include_once("model/db/TableUser.class.php");
  $userTable = new TableUser($db);
  
  $allUsers = $userTable->listAll();
//  $oneEntry = $allUsers->fetchObject();
//	$testOut = print_r($oneEntry, true);
//	$trace->info("<pre>$testOut</pre>");

  return include_once("view/admin/users-html.php");
}
else {
  $html = "Forbidden";
}

return $html;
?>