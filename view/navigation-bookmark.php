<?php
$cl_bookmark = (!isset($_GET['page']) ||
                 (isset($_GET['page']) && ($_GET['page'] === "bookmarks"))) ? " class=\"active\"" : "";

if ($user->isLoggedIn()) {
  $cl_upload = (isset($_GET['page']) && ($_GET['page'] === 'upload')) ? " class=\"active\"" : "";
  
  $cl = (empty($cl_bookmark) && empty($cl_upload)) ? " class=\"dropdown\"" : " class=\"active dropdown\"";
  
  $li = "<li{$cl}>";
  $li .= "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>Bookmarks <span class='badge'>$totalBms</span> <span class='caret'></span></a>";
  $li .= "<ul class='dropdown-menu' role='menu'>";
  $li .= "  <li{$cl_bookmark}><a href='index.php?page=bookmarks'>Bookmarks</a></li>";
  $li .= "  <li class='divider'></li>";
  $li .= "  <li{$cl_upload}><a href='index.php?page=upload'>Import</a></li>";
  $li .= "</ul>";
  $li .= "</li>";
}
else {
  $li = "<li{$cl_bookmark}><a href=\"index.php?page=bookmarks\">Bookmarks <span class='badge'>$totalBms</span></a></li>";
}

return $li;
?>