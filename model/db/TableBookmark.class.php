<?php
include_once("model/db/Table.class.php");

class TableBookmark extends Table {
  
  public function create($url, $userid, $description, $icon=null, $folder=1) {
    $this->checkUrl($url);
    $sql = "insert into bookmark (url, username, description, icon, folder) values(?, ?, ?, ?, ?)";
    $data = array($url, $userid, $description, $icon, $folder);
    $this->makeStatement($sql, $data);
  }
  
  private function checkUrl($url, $userid, $folder) {
    $sql = "select url from bookmark where url=? and username=? and folder=?";
    $data = array($url, $userid, $folder);
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
              `description` varchar(1024) NOT NULL,
              `username` int(11) NOT NULL,
              `folder` int(2) NOT NULL DEFAULT '1' COMMENT '1 - root',
              `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `rate` int(1) NOT NULL DEFAULT '0',
              `icon` text,
              `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 - ok',
              PRIMARY KEY (`id_bookmark`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    $this->makeStatement($sql);
  }
}
?>