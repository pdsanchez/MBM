<?php
include_once("model/db/Table.class.php");

class TableFolder extends Table {
  
  public function create($name, $parent=1) {
    $this->checkFolder($name, $parent);
    $sql = "insert into folder (name, parent) values(?, ?)";
    $data = array($name, $parent);
    $this->makeStatement($sql, $data);
  }
  
  private function checkFolder($name, $parent) {
    $sql = "select name from folder where name=? and parent=?";
    $data = array($name, $parent);
    $stmt = $this->makeStatement($sql, $data);
    if($stmt->rowCount() === 1) {
      throw new Exception("Error: '$name' already used");
    }
  }
  
  public function install() {
    $sql = "DROP TABLE IF EXISTS `folder`;
            CREATE TABLE IF NOT EXISTS `folder` (
              `id_folder` int(2) NOT NULL AUTO_INCREMENT,
              `name` varchar(64) NOT NULL,
              `parent` int(2) NOT NULL DEFAULT '1' COMMENT '1 - root',
              PRIMARY KEY (`id_folder`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $this->makeStatement($sql);
  }
}
?>