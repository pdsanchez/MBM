<?php
return <<<HTML
<form method="post" action="index.php?page=upload" enctype="multipart/form-data">
  <p>$uploaderMsg</p>
  <input type="file" name="upd-bookmarks">
  <input type="submit" name="new-bookmarks-file" value="Upload your bookmarks file">
</form>
HTML;
?>