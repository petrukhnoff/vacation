<?php
class CustomersDB implements CustomersInterfaceDB {
  public $db;
  public function __construct($db) {
    $this->db = $db;
  }
  
  public function Select() {
    $query = $this->db->query('SELECT id, name FROM `customers` WHERE 1');
    $outPut = [];
    while ($row = $query->fetch_assoc()) {
      $outPut[$row['id']] = new Customers($row['id'], $row['name']);
    }
    return $outPut;
  }

  public function Insert($obj) {
    if ($this->db->query("INSERT INTO customers (name) VALUES ('" . $obj->getName() . "')")) {
      return true;
    }
    return false;
  }
  
  public function Update($obj) {
    if ($this->db->query("UPDATE customers SET name = '" . $obj->getName() . " WHERE id = " . $obj->getId() . "")) {
      return true;
    }
    return false;
  }
  
  public function Delete($obj) {
    if ($this->db->query("DELETE FROM customers WHERE id = " . $obj->getId() . "")) {
      return true;
    }
    return false;
  }
}