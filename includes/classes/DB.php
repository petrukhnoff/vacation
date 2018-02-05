<?php
class DB extends mysqli {
  public function __construct($host, $user, $pass, $db) {
    parent::__construct($host, $user, $pass, $db);
    if (mysqli_connect_error()) {
      die('connect error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
    }
  }
}