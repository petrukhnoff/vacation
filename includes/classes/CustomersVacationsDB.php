<?php
class CustomersVacationsDB extends CustomersDB implements CustomersInterfaceDB {

  public function Select() {
    $query = $this->db->query('SELECT * FROM `customers` WHERE 1');
    $outPut = [];
    while ($row = $query->fetch_assoc()) {
      $outPut[$row['id']] = new CustomersVacations($row['id'], $row['name'], $row['all_days'], $row['used_days'], $row['request_days']);
    }
    return $outPut;
  }
  
  public function Insert($obj) {
    if ($this->db->query("INSERT INTO customers (`name`, `all_days`, `used_days`, `request_days`) VALUES ('" . $obj->getName() . "', '" . $obj->getAllDays() . "', '" . $obj->getUsedDays() . "', '" . $obj->getRequestDays() . "')")) {
      return true;
    }
    return false;
  }
  
  public function Update($obj) {
    if ($this->db->query("UPDATE customers SET name = '" . $obj->getName() . "', all_days = '" . $obj->getAllDays() . "', used_days = '" . $obj->getUsedDays() . "', request_days = '" . $obj->getRequestDays() . "' WHERE id = " . $obj->getId() . "")) {
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