<?php
require_once 'includes\app.php';
global $db;

$oCustomersVacationsDB = new CustomersVacationsDB($db);
$aCustomersVacations = $oCustomersVacationsDB->Select();

$sMessage = '';
switch ($_POST['action']) {
  case "add":
    if ($_POST['name'] != '') {
      $newCustomersVacations = new CustomersVacations(null, $_POST['name'], $_POST['vacations_days']);
      if($oCustomersVacationsDB->Insert($newCustomersVacations)) {
        $sMessage = 'added';
      } else {
        $sMessage = 'error';
      }
    }
    break;
    case "delete":
    if ($_POST['delete_customer']) {
      $oDeleteCustomersVacations = $aCustomersVacations[$_POST['delete_customer']];
      if($oCustomersVacationsDB->Delete($oDeleteCustomersVacations)) {
        $sMessage = 'deleted';
      } else {
        $sMessage = 'error';
      }
    }
    break;
  case "request":
    if ($_POST['select_customer']) {
      $oUpdateCustomersVacations = $aCustomersVacations[$_POST['select_customer']];
      $oUpdateCustomersVacations->setRequestDays($_POST['request_days']);
      if ($oUpdateCustomersVacations->checkVacations()) {
        if($oCustomersVacationsDB->Update($oUpdateCustomersVacations)) {
          $sMessage = 'request added';
        } else {
          $sMessage = 'error';
        }
      } else {
        $sMessage = 'this number of days is not available to you';
      }
    }
    break;
  case "confirm":
    foreach ((array)$_POST['confirm_vacation_request'] as $iCId => $sApproval) {
      $oUpdateCustomersVacations = $aCustomersVacations[$iCId];
      if ($sApproval == 'yes')  {
        $oUpdateCustomersVacations->confirmVacations(true);
      } elseif ($sApproval == 'no') {
        $oUpdateCustomersVacations->confirmVacations(false);
      }
      $oCustomersVacationsDB->Update($oUpdateCustomersVacations);
    }
     $sMessage = 'confirm';
    break;
}
$aCustomersVacations = $oCustomersVacationsDB->Select();
$db->close();
?>
<!DOCTYPE html>
<html>
	<head>
  <meta charset="utf-8">
	</head>
	<body>
    <?php
    echo $sMessage;
    ?>
    <br>
    <form name="test" method="post" action="">
      <br>
      Add customer:<br><br>
      Name:<input type="text" size="40" name="name" value="">
      Vacations days:<input type="number" size="20" name="vacations_days" value="21" max="21">
      <input type="hidden" name="action" value="add">
      <input type="submit" value="Add">
    </form>
    <br>
    <form name="test" method="post" action="">
      Delete customer:<br>
      Name:
      <select name="delete_customer">
        <?php 
        foreach ($aCustomersVacations as $iCId => $obj) {
          echo '<option value=' . $obj->getId() . '>' . $obj->getName() . '</option>';
        }
        ?> 
      </select>
      <input type="hidden" name="action" value="delete">
      <input type="submit" value="Delete">
    </form>
    <br>
    <form name="test" method="post" action="">
      Vacation request:<br>
      Name:
      <select name="select_customer">
        <?php 
        foreach ($aCustomersVacations as $iCId => $obj) {
          echo '<option value=' . $obj->getId() . '>' . $obj->getName() . '</option>';
        }
        ?> 
      </select>
      Request days:<input type="number" size="20" name="request_days" value="0" max="21">
      <input type="hidden" name="action" value="request">
      <input type="submit" value="Request">
    </form>
    <br>
    <form name="test" method="post" action="">
      Confirm vacation request:<br><br>
        <?php 
        foreach ($aCustomersVacations as $iCId => $obj) {
          $iAvailable = $obj->getAllDays() - $obj->getUsedDays();
          echo 'customer: ' . $obj->getName() . ', requested days:'.$obj->getRequestDays().', used days: '.$obj->getUsedDays().', number of days available: '.$obj->getAllDays().'<br>
            <input type="radio" name="confirm_vacation_request['.$obj->getId().']" value="" checked="checked">Ignore
            <input type="radio" name="confirm_vacation_request['.$obj->getId().']" value="yes">yes
            <input type="radio" name="confirm_vacation_request['.$obj->getId().']" value="no">no<br>';
        }
        ?> 
      <input type="hidden" name="action" value="confirm">
      <input type="submit" value="Confirm">
    </form>
	</body>
</html>