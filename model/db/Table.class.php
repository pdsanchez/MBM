<?php
abstract class Table {
  protected $db;
  
  public function __construct($db) {
    $this->db = $db;
  }
  
  protected function makeStatement($sql, $data = null) {
    $stmt = $this->db->prepare($sql);
    
    try {
      $stmt->execute($data);
    }
    catch(Exception $e) {
      $msg = "<p>You tried to run this sql: $sql</p>
              <p>Exception: $e</p>";
      trigger_error($msg);
    }
    
    return $stmt;
  }
}
?>