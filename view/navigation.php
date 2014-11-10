<?php
$admin_nav_entry = function($page, $item) use ($user) {
  $li = "";
  if ($user->isAdmin()) {
    $cl = (isset($_GET['page']) && $_GET['page'] === $page) ? " class=\"active\"" : "";
    $li = "<li{$cl}><a href=\"index.php?page=$page\">$item</a></li>";
  }
  return $li;
};

$headerPanel = include_once "view/navigation-header.php";

$loginPanel =  ($user->isLoggedIn()) ?
  include_once "view/navigation-logout.php" :
  include_once "view/navigation-login.php";
  
$bookmarkEntry = include_once "view/navigation-bookmark.php";

return <<<HTML
<nav id="admin-nav" class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    $headerPanel
    
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        {$bookmarkEntry}
        {$admin_nav_entry("users", "Users")}
        {$admin_nav_entry("user-new", "Create User")}
        {$admin_nav_entry("logs", "Logs")}
      </ul>
      $loginPanel
    </div>
  </div>
</nav>
HTML;
?>