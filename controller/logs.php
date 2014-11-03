<?php
if ($user->isAdmin()) {
  $pagedata->setTitle("MBM:MyBookMarks #Logs");
  
  $html = "Logs---";
}
else {
  $html = "Forbidden";
}

return $html;
?>