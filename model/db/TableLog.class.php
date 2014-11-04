<?php
include_once "model/db/Table.class.php";

class TableLog extends Table { 
  public function install() {
    $sql = "DROP TABLE IF EXISTS log;
            CREATE TABLE IF NOT EXISTS log (
              timestamp DATETIME,
              thread INTEGER,
              logger VARCHAR(256),
              level VARCHAR(32),
              message VARCHAR(4000),
              file VARCHAR(255),
              line VARCHAR(10)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
    $this->makeStatement($sql);
  }
}
?>