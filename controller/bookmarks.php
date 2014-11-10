<?php
const PG_LIMIT = 15;
const PG_TOTAL_INDEX = 5;

include_once "model/db/TableBookmark.class.php";

if(isset($searchObj)) {
  $tPages = ceil($searchObj->total/PG_LIMIT);
  //$tPages = round($searchObj->total/PG_LIMIT, 0, PHP_ROUND_HALF_UP);
}
else {
  $tPages = ceil($totalBms/PG_LIMIT);
  //$tPages = round($totalBms/PG_LIMIT, 0, PHP_ROUND_HALF_UP);
}

//$trace->debug("TPAGES: ".$tPages);
//$trace->debug("<pre>".print_r($searchObj, true)."</pre>");

$idx = 1;
if (isset($_GET['idx'])) {
  $idx = $_GET['idx'];
  if ($idx === 'first') {
    $idx = 1;
  }
  else if ($idx === 'last') {
    $idx = $tPages;
  }
}

$tBm = new TableBookmark($db);
if(isset($searchObj)) {
  $allBms = $tBm->search($searchObj->term, $idx, PG_LIMIT, $user->getId());
}
else {
  $allBms = $tBm->getBookmarks($idx, PG_LIMIT, $user->getId());
}

$pagination = array();
if ($tPages == 0) {
  return "NO BOOKMARKS"; // TODO
}
else if ($tPages <= PG_TOTAL_INDEX) {
  $pagination = range(1, $tPages);
}
else {
  if($idx-2 <= 0) {
    $pagination = range(1, PG_TOTAL_INDEX);
  }
  else if ($idx+2 >= $tPages) {
    $pagination = range($tPages-PG_TOTAL_INDEX+1, $tPages);
  }
  else {
    array_push($pagination, $idx-2, $idx-1, $idx, $idx+1, $idx+2);
  }
  array_unshift($pagination, 'first');
  array_push($pagination, 'last');
}

//$trace->debug("<pre>".print_r($pagination, true)."</pre>");

return include_once "view/bookmarks-html.php";
?>