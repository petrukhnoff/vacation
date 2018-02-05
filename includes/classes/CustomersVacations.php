<?php
class CustomersVacations extends Customers {
  private $allDays;
  private $usedDays;
  private $requestDays;
  private $availableDays;

  public function __construct($id, $name, $allDays, $usedDays = 0, $requestDays = 0)  {
    parent :: __construct($id, $name);
    $this->allDays = $allDays;
    $this->usedDays = $usedDays;
    $this->requestDays = $requestDays;
    $this->availableDays = $allDays - $usedDays;
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
  
  public function getAvailableDays() {
     return $this->availableDays;
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
    if (($this->availableDays) >= $this->requestDays) {
      return true;
    }
    $this->requestDays = 0;
    return false;
  }
  
  public function confirmVacations($bConfirm) {
    if ($bConfirm) {
      $this->usedDays = $this->usedDays + $this->requestDays;
      $this->requestDays = 0;
    } else {
      $this->requestDays = 0;
    }
  }
}