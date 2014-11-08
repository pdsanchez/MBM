<?php
include_once "model/db/Table.class.php";

class TableUser extends Table {
  public function checkCredentials($username, $pwd) {
    $sql = "select id_user, role from user where username = ? and pwd = SHA1(?)";
    $data = array($username, $pwd);
    $stmt = $this->makeStatement($sql, $data);
    if ($stmt->rowCount() === 1) {
      $reg = $stmt->fetchObject();
      $obj = new stdClass();
      $obj->id = $reg->id_user;
      $obj->username = $username;
      $obj->role = $reg->role;
    }
    else {
      throw new Exception("Login failed");
    }
    return $obj;
  }
  
  public function create($username, $pwd, $role=2, $email=null) {
    $this->checkUser($username);
    $sql = "insert into user (username, pwd, role, email) values(?, SHA1(?), ?, ?)";
    $data = array($username, $pwd, $role, $email);
    $this->makeStatement($sql, $data);
  }
  
  public function listAll() {
    $sql = "select id_user, username, email, role from user";
    return $this->makeStatement($sql);
  }
  
  public function deleteByName($username) {
    $sql = "delete from user where username=?";
    $data = array($username);
    $this->makeStatement($sql, $data);
  }
  
  public function deleteById($id) {
    $sql = "delete from user where id_user=?";
    $data = array($id);
    $this->makeStatement($sql, $data);
  }
  
  public function updateById($id, $role=2, $email=null) {
    $sql = "update user set role=?, email=? where id_user=?";
    $data = array($role, $email, $id);
    $this->makeStatement($sql, $data);
  }
  
  public function changePassword($username, $newPwd1, $newPwd2) {
    if ($newPwd1 === $newPwd2) {
      $sql = "update user set pwd=SHA1(?) where username=?";
      $data = array($newPwd1, $username);
      $this->makeStatement($sql, $data);
    }
    else {
      throw new Exception("Error in passwords");
    }
  }
  
  public function getById($id) {
    $sql = "select id_user, username, pwd, email, role from user where id_user=?";
    $data = array($id);
    return $this->makeStatement($sql, $data)->fetchObject();
  }
  
  private function checkUser($username) {
    $sql = "select username from user where username=?";
    $data = array($username);
    $stmt = $this->makeStatement($sql, $data);
    if($stmt->rowCount() === 1) {
      throw new Exception("Error: '$username' already used");
    }
  }
  
  public function install() {
    $sql = "DROP TABLE IF EXISTS `user`;
            CREATE TABLE IF NOT EXISTS `user` (
              `id_user` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(16) NOT NULL,
              `pwd` varchar(256) NOT NULL,
              `email` varchar(64) DEFAULT NULL,
              `role` int(1) NOT NULL DEFAULT '2' COMMENT '1-admin, 2-user',
              PRIMARY KEY (`id_user`),
              UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $this->makeStatement($sql);
  }
}
?>