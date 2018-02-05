<?php
interface CustomersInterfaceDB {
  
  public function Select(); 
  
  public function Insert($obj);
  
  public function Update($obj);
  
  public function Delete($obj);
  
}
