<?php
class DB {
  function __construct() {
    return new mysqli(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);
  }
  
  public function insert() {
    var_dump($this);
  }

  function __destruct() {
    
  }
}