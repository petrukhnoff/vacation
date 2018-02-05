<?php
class CustomersVacations extends Customers {
  private $allDays;
  private $usedDays;
  private $requestDays;
  
  public function __construct($id, $name, $allDays, $usedDays = 0, $requestDays = 0)  {
    parent :: __construct($id, $name);
    $this->allDays = $allDays;
    $this->usedDays = $usedDays;
    $this->requestDays = $requestDays;
  }
  
  public function getAllDays() {
    return $this->allDays;
  }
  
  public function getUsedDays() {
    return $this->usedDays;
  }
  
  public function getRequestDays() {
    return $this->requestDays;
  }
  
  public function setAllDays($allDays) {
    $this->allDays = $allDays;
  }
  
  public function setUsedDays($usedDays) {
    $this->usedDays = $usedDays;
  }
  
  public function setRequestDays($requestDays) {
    $this->requestDays = $requestDays;
  }
  
  public function checkVacations() {
    if ($this->allDays >= $this->requestDays) {
      return true;
    }
    $this->requestDays = 0;
    return false;
  }
  
  public function confirmVacations($bConfirm) {
    if ($bConfirm) {
      $this->allDays = $this->allDays - $this->requestDays;
      $this->usedDays = $this->usedDays + $this->requestDays;
      $this->requestDays = 0;
    } else {
      $this->requestDays = 0;
    }
  }
}