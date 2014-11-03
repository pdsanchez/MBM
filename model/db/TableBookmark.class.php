<?php
include_once("model/db/Table.class.php");

class TableBookmark extends Table {
  
  public function create($url, $username, $folder=1, $description=null) {
    $this->checkUrl($url);
    $sql = "insert into bookmark (url, username, folder, description) values(?, ?, ?, ?)";
    $data = array($name, $parent);
    $this->makeStatement($sql, $data);
  }
  
  private function checkUrl($url, $username, $folder) {
    $sql = "select url from bookmark where url=? and username=? and folder=?";
    $data = array($url, $username, $folder);
    $stmt = $this->makeStatement($sql, $data);
    if($stmt->rowCount() === 1) {
      throw new Exception("Error: '$url' already used");
    }
  }
  
  public function install() {
    $sql = "DROP TABLE IF EXISTS `bookmark`;
            CREATE TABLE IF NOT EXISTS `bookmark` (
              `id_bookmark` int(11) NOT NULL AUTO_INCREMENT,
              `url` varchar(1024) NOT NULL,
              `description` varchar(1024) DEFAULT NULL,
              `username` int(11) NOT NULL,
              `folder` int(2) NOT NULL DEFAULT '1' COMMENT '1 - root',
              `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 - ok',
              PRIMARY KEY (`id_bookmark`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $this->makeStatement($sql);
  }
}
?>