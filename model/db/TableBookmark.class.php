<?php
include_once("model/db/Table.class.php");

class TableBookmark extends Table {
  
  public function create($url, $userid, $description, $icon=null, $folder=1) {
    $this->checkUrl($url, $userid, $folder);
    $sql = "insert into bookmark (url, username, description, icon, folder) values(?, ?, ?, ?, ?)";
    $data = array($url, $userid, $description, $icon, $folder);
    $this->makeStatement($sql, $data);
  }
  
  public function getTotal($userid=0) {
    $sql = "select count(*) from bookmark where username=?";
    $data = array($userid);
    return $this->makeStatement($sql, $data)->fetch(PDO::FETCH_NUM)[0];
  }
  
  private function checkUrl($url, $userid, $folder) {
    $sql = "select url from bookmark where url=? and username=? and folder=?";
    $data = array($url, $userid, $folder);
    $stmt = $this->makeStatement($sql, $data);
    if($stmt->rowCount() === 1) {
      throw new Exception("Error: '$url' already used");
    }
  }
  
  public function getTotalSearch($term, $userid=0) {
    $sql = "select count(*) from bookmark ";
    $sql .= "where username=? and url like ? and description like ?";
    $data = array($userid, "%$term%", "%$term%");
    return $this->makeStatement($sql, $data)->fetch(PDO::FETCH_NUM)[0];
  }
  
  public function search($term, $idx, $offset, $userid=0) {
    $limit_v1 = ($idx-1)*$offset;
    $limit_v2 = $offset;
    $sql = "select url, description, rate, date, icon from bookmark";
    $sql .= " where username=? and url like ? and description like ? limit $limit_v1, $limit_v2";
    $data = array($userid, "%$term%", "%$term%");
    return $this->makeStatement($sql, $data);
  }
  
  public function getBookmarks($idx, $offset, $userid=0) {
    $limit_v1 = ($idx-1)*$offset;
    $limit_v2 = $offset;
    $sql = "select url, description, rate, date, icon from bookmark where username=? limit $limit_v1, $limit_v2";
    $data = array($userid);
    return $this->makeStatement($sql, $data);
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