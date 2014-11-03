<?php
class UserLogin {
  public function __construct() {
    session_start();
  }
  
  public function isLoggedIn() {
    return (isset($_SESSION["logged-in"]) ? $_SESSION["logged-in"] : false);
  }
  
  public function getName() {
    return (isset($_SESSION["name"]) ? $_SESSION["name"] : "");
  }
  
  public function getRole() {
    return (isset($_SESSION["role"]) ? $_SESSION["role"] : "");
  }
  
  public function isAdmin() {
    return (isset($_SESSION["role"]) && $_SESSION["role"] === '1');
  }
  
  public function login($name, $role) {
    $_SESSION["logged-in"] = true;
    $_SESSION["name"] = $name;
    $_SESSION["role"] = $role;
  }
  
  public function logout() {
    $_SESSION["logged-in"] = false;
    $_SESSION["name"] = null;
    $_SESSION["role"] = null;
  }
}
?>