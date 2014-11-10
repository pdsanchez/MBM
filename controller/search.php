<?php
if (isset($_POST['bm-search'])) {
  include_once "model/db/TableBookmark.class.php";

  $tBm = new TableBookmark($db);

  $searchObj = new stdClass();
  $searchObj->term = $_POST['bookmarks-search'];
  $searchObj->total = $tBm->getTotalSearch($searchObj->term, $user->getId());
}
else if (isset($_GET['term'])) {
  $searchObj = new stdClass();
  $searchObj->term = $_GET['term'];
  $searchObj->total = $_GET['total'];
}
return include_once "controller/bookmarks.php";
?>