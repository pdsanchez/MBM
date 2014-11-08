<?php
include_once "model/Uploader.class.php";
include_once "model/ScrapeBookmarkFile.class.php";
include_once "model/db/TableBookmark.class.php";

if (isset($_POST["new-bookmarks-file"])) {
  
  $testOut = "<pre>";
  $testOut .= print_r($_FILES, true);
  $testOut .= "</pre>";
  $trace->debug($testOut);
  
  $uploader = new Uploader("upd-bookmarks");
  try {
    $uploader->save("tmp");
    $uploaderMsg = "file uploaded";
    
//$xmlPageDom = new DomDocument();	// Instantiating a new DomDocument object
//@$xmlPageDom->loadHTMLFile("tmp/{$uploader->getFilename()}");	// Loading the HTML from downloaded page
//$xmlPageXPath = new DOMXPath($xmlPageDom);	// Instantiating new XPath DOM object
//$xml = simplexml_import_dom($xmlPageDom); // or simplexml_load_string()
//$json = json_encode($xml);
//$trace->debug($json);
//$trace->debug($xml);

//$arr = $xmlPageXPath->query("//a");
//$arr = $xmlPageDom->getElementsByTagName("a");
//$nd = $arr->item(0)->childNodes;

//foreach($arr as $item) {
//  $trace->info($item->nodeName . " --- " . utf8_decode($item->nodeValue));
//  $trace->debug($item->attributes->getNamedItem("href")->nodeValue);
//  $trace->debug($item->attributes->getNamedItem("icon")->nodeValue);
//}

    $tBm = new TableBookmark($db);
    
    $scrape = new ScrapeBookmarkFile("tmp/{$uploader->getFilename()}");
    $a = $scrape->getLinks();
    
    foreach ($a as $obj) {
      //$trace->debug($obj->url . " -- " . $obj->description . " [" . $user->getName() . "]");
      $tBm->create($obj->url, $user->getId(), $obj->description, $obj->icon);
    }
  }
  catch (Exception $e) {
    $uploaderMsg = $e->getMessage();
  }
}

return include_once "view/form-upload-bookmarks.php";
?>