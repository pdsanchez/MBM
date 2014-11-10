<?php
if (isset($allBms) === false) {
  trigger_error('view/admin/bookmarks-html.php needs $allBms');
}

$term = (isset($searchObj)) ? $searchObj->term : "";

$limit_v1 = ($idx-1)*PG_LIMIT+1;
$limit_v2 = ($idx-1)*PG_LIMIT+$allBms->rowCount();
$total = (isset($searchObj)) ? $searchObj->total : $totalBms;

$html = "<div class='row'>";
$html .= "<div class='col-sm-6 text-left'>";
$html .= "<p>Showing $limit_v1 to $limit_v2 of $total entries</p>";
$html .= "</div>";
$html .= "<div class='col-sm-6 text-right'>";
$html .= "<form method='post' action='index.php?page=search'>";
$html .= "<input type='search' name='bookmarks-search' value='$term'>";
$html .= "<input type='submit' value='search' name='bm-search'>";
$html .= "</form>";
$html .= "</div>";
//$html .= ($pagination) ? getPaginationHTML($pagination, $idx, @$searchObj) : "";
$html .= "<table id='tbookmarks' class='table table-striped'>";
$html .= "<tr><th>icon</th><th>url</th><th>description</th><th>rate</th><th>date</th></tr>";
while ($bm = $allBms->fetchObject()) {
  $img = ($bm->icon) ? "<img src='{$bm->icon}'>" : "";
  $url = (strlen($bm->url) > 43) ? substr($bm->url,0,40).'...' : $bm->url;
  
  $html .= "<tr><td>$img</td><td><a href='{$bm->url}'>$url</a></td>";
  $html .= "<td>{$bm->description}</td>";
  $html .= "<td>{$bm->rate}</td>";
  $html .= "<td>{$bm->date}</td></tr>";
}
$html .= "</table>";
$html .= ($pagination) ? getPaginationHTML($pagination, $idx, @$searchObj) : "";
$html .= "</div>";

return $html;

function getPaginationHTML($pagination, $idx, $searchObj) {
  global $totalBms;
  
  $html = "<div class='col-xs-12'>";
  $html .= "<nav>";
  $html .= "  <ul class='pagination'>";
  foreach ($pagination as $item) {
    if ($item === 'first') {
      $a = '&laquo;';
      $cl = "";
    }
    else if ($item === 'last') {
      $a = '&raquo;';
      $cl = "";
    }
    else {
      $a = $item;
      $cl = (intval($item) === intval($idx)) ? " class='active'" : "";
    }
    $page = (isset($searchObj)) ? "search&term={$searchObj->term}&total={$searchObj->total}" : "bookmarks";
    $html .= "    <li{$cl}><a href='index.php?page=$page&idx=$item'>$a</a></li>";
  }
  $html .= " </ul>";
  $html .= "</nav>";
  $html .= "</div>";
  
  
  //$html .= "<div class='col-xs-6'>";
  //$html .= "<p>Showing $limit_v1 to $limit_v2 of $total entries</p>";
  //$html .= "</div>";
  
  return $html;
}
?>