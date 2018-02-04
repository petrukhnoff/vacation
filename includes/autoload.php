<?php
spl_autoload_register(function ($class_name) {
  var_dump($class_name);
  switch (true) {
    case file_exists('includes/classes/' . $class_name . '.php'):
      $path = 'includes/classes/' . $class_name . '.php';
      break;
  }
  if ($path) {
    require_once $path;
  }
});