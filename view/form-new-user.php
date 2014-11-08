<?php
$role = function() use ($user) {
  if ($user->isAdmin()) {
    $html = "<div class='form-group'>
              <label for='role' class='col-sm-2 control-label'>role</label>
              <div class='col-sm-10'>
                <select name='role'>
                  <option value='1'>Admin</option>
                  <option value='2' selected>User</option>
                </select>
              </div>
            </div>";
  }
  else {
    $html = "<intput type='hidden' name='role' value='2'>";
  }
  return $html;
};

return "
  <form method='post' action='index.php?page=user-new' class='form-horizontal' role='form'>
    <fieldset>
      <legend>Create new user</legend>
      <div class='form-group'>
        <label for='username' class='col-sm-2 control-label'>username</label>
        <div class='col-sm-10'>
          <input type='text' name='username' required>
        </div>
      </div>
      <div class='form-group'>
        <label for='pwd' class='col-sm-2 control-label'>password</label>
        <div class='col-sm-10'>
          <input type='password' name='pwd' required>
        </div>
      </div>
      <div class='form-group'>
        <label for='email' class='col-sm-2 control-label'>email</label>
        <div class='col-sm-10'>
          <input type='email' name='email'>
        </div>
      </div>
      {$role()}
      <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
          <input type='submit' value='create user' name='new-user'>
        </div>
      </div>
    </fieldset>
  </form>";
?>