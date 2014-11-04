<?php
include_once "model/db/TableBookmark.class.php";
include_once "model/db/TableFolder.class.php";

$tBm = new TableBookmark($db);

if (isset($_POST["new-bookmark"])) {
  
}
else {
  $tFolder = new TableFolder($db);
  
}



include_once "view/form-bookmark.php";

?>