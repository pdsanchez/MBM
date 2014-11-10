<?php
$role = ($user->isAdmin()) ? "[Admin]" : "";

return <<<HTML
<form class="navbar-form navbar-right" method="post" action="index.php">
  <input class="btn btn-link" type="submit" value="logout" name="logout">
</form>
<p class="navbar-text navbar-right"><span class="glyphicon glyphicon-user"></span> logged in as {$user->getName()} $role</p>
HTML;
?>