<?php

$admin_nav_entry = function($page, $item) use ($user) {
  return ($user->isAdmin()) ? "<li><a href=\"index.php?page=$page\">$item</a></li>" : "";
};

if ($user->isLoggedIn()) {
  $role = ($user->isAdmin()) ? "[Admin]" : "";
  $loginPanel = "<form class='navbar-form navbar-right' method='post' action='index.php'>
                  <input class='btn btn-link' type='submit' value='logout' name='logout'>
                </form>
                <p class='navbar-text navbar-right'>logged in as {$user->getName()} $role</p>";
}
else {
  $loginPanel = "<ul class='nav navbar-nav navbar-right'>
                  <li><a href='index.php?page=new-user'>Register</a></li>
                </ul>
                <form class='navbar-form navbar-right' method='post' action='index.php'>
                  <div class='form-group'>
                    <input type='text' class='form-control' name='username' required placeholder='username'>
                  </div>
                  <div class='form-group'>
                    <input type='password' class='form-control' name='pwd' required placeholder='password'>
                  </div>
                  <input type='submit' class='btn btn-default' value='login' name='login'>
                </form>";
}

return <<<HTML
<nav id="admin-nav" class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">MBM</a>
    </div>
    
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li class="active"><a href="index.php?page=bookmarks">Bookmarks</a></li>
        {$admin_nav_entry("users", "Users")}
        {$admin_nav_entry("new-user", "Create User")}
        {$admin_nav_entry("logs", "Logs")}
      </ul>
      $loginPanel
    </div>
  </div>
</nav>
HTML;
?>

<!--
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div>
-->