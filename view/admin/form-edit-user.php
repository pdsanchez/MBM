<?php
if (isset($usrMsg) === false) {
  $usrMsg = "";
}
if (!isset($usr)) {
  trigger_error('view/admin/form-edit-user.php needs $usr');
}

$v = print_r($usr,true);
  $trace->info("USER: <pre>$v</pre>");
  
$op1 = ($usr->role == '1') ? "selected" : "";
$op2 = ($usr->role == '2') ? "selected" : "";

return "
  <form method='post' action='index.php?page=user-edit' class='form-horizontal' role='form'>
    <input type='hidden' name='id' value='{$usr->id_user}'>
    <input type='hidden' name='username' value='{$usr->username}'>
    <fieldset>
      <legend>Create new user</legend>
      <div class='form-group'>
        <label class='col-sm-2 control-label'>username</label>
        <div class='col-sm-10'>
          <p class='form-control-static'>{$usr->username}</p>
        </div>
      </div>
      <div class='form-group'>
        <label for='pwd1' class='col-sm-2 control-label'>new password</label>
        <div class='col-sm-10'>
          <input type='password' name='pwd1'>
        </div>
      </div>
      <div class='form-group'>
        <label for='pwd2' class='col-sm-2 control-label'>new password retype</label>
        <div class='col-sm-10'>
          <input type='password' name='pwd2'>
        </div>
      </div>
      <div class='form-group'>
        <label for='email' class='col-sm-2 control-label'>email</label>
        <div class='col-sm-10'>
          <input type='email' name='email' value='{$usr->email}'>
        </div>
      </div>
      <div class='form-group'>
        <label for='role' class='col-sm-2 control-label'>role</label>
        <div class='col-sm-10'>
          <select name='role'>
            <option value='1' {$op1}>Admin</option>
            <option value='2' {$op2}>User</option>
          </select>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-offset-2 col-sm-10'>
          <input type='submit' value='update user' name='upd-user'>
        </div>
      </div>
    </fieldset>
  </form>
  <p id='admin-form-msg'>$usrMsg</p>";
?>