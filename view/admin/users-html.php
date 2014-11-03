<?php
$usrFound = isset($allUsers);
if ($usrFound === false) {
  trigger_error('view/admin/users-html.php needs $allUsers');
}

$html = "<table id='tusers' class='table table-striped'>";
$html .= "<tr><th>username</th><th>email</th><th>role</th><th>update</th><th>delete</th></tr>";
while ($usr = $allUsers->fetchObject()) {
  $role = ( ($usr->role === '1') ? "admin" : "user" ) . " [".$usr->role."]";
  $html .= "<tr><td>{$usr->username}</td><td>{$usr->email}</td><td>{$role}</td>";
  $html .= "<td><a href='index.php?page=users&name={$usr->username}'><span class='glyphicon glyphicon-edit'></span></a></td>";
  $html .= "<td><a href='index.php?page=users&name={$usr->username}'><span class='glyphicon glyphicon-trash'></a></td></tr>";
}
$html .= "</table>";

return $html;
?>