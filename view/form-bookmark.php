<?php
return <<<HTML
<form method="post" action="index.php?page=new-bookmark" class="form-horizontal" role="form">
  <fieldset>
    <legend>Create new bookmark</legend>
    <div class="form-group">
      <label for="url" class="col-sm-2 control-label">url</label>
      <div class="col-sm-10">
        <input type="url" name="url" required>
      </div>
    </div>
    <div class="form-group">
      <label for="folder" class="col-sm-2 control-label">folder</label>
      <div class="col-sm-10">
        <input type="text" name="folder" required>
      </div>
    </div>
    <div class="form-group">
      <label for="description" class="col-sm-2 control-label">description</label>
      <div class="col-sm-10">
        <textarea name="description"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" value="create bookmark" name="new-bookmark">
      </div>
    </div>
  </fieldset>
</form>";
HTML;
?>