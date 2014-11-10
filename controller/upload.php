<?php
if ($user->isLoggedIn()) {
  include_once "model/Uploader.class.php";
  include_once "model/ScrapeBookmarkFile.class.php";
  include_once "model/db/TableBookmark.class.php";
  
  if (isset($_POST["new-bookmarks-file"])) {
    
    //$testOut = "<pre>";
    //$testOut .= print_r($_FILES, true);
    //$testOut .= "</pre>";
    //$trace->debug($testOut);
    
    $uploader = new Uploader("upd-bookmarks");
    try {
      $uploader->save("tmp");
      $uploaderMsg = "file uploaded";
      
      $tBm = new TableBookmark($db);
      
      $scrape = new ScrapeBookmarkFile("tmp/{$uploader->getFilename()}");
      $a = $scrape->getLinks();
      
      foreach ($a as $obj) {
        try {
          $tBm->create($obj->url, $user->getId(), $obj->description, $obj->icon);
        } catch(Exception $e) {
          
        }
      }
    }
    catch (Exception $e) {
      $uploaderMsg = $e->getMessage();
    }
  }
  
  $html = include_once "view/form-upload-bookmarks.php";
}
else {
  $html = "Forbidden";
}

return $html;
?>