<?php

spl_autoload_register(function($name) {
  foreach ([ROOT . $name . '.php'] as $fullName) {
    $fullName = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fullName);

    if (file_exists($fullName)) include $fullName;
  }
});
