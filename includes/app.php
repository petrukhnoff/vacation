<?php
require_once 'includes\config.php';
require_once 'includes\autoload.php';
$DB = new DB();
$DB->query();
print_r($DB);
echo 'ddfs';