<?php
return <<<HTML
<ul class='nav navbar-nav navbar-right'>
<li><a href="index.php?page=user-new">Register</a></li>
</ul>
<form class="navbar-form navbar-right" method="post" action="index.php">
<div class="form-group">
  <input type="text" class="form-control" name="username" required placeholder="username">
</div>
<div class="form-group">
  <input type="password" class="form-control" name="pwd" required placeholder="password">
</div>
<input type="submit" class="btn btn-default" value="login" name="login">
</form>
HTML;
?>