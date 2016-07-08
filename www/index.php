<?php
  define('ROOT', realpath('../') . '/');

  require ROOT . 'autoload.php';

  $config = require ROOT . 'app/config/main.php';

  $app = app\Application::inst();

  $app->init($config);

  $app->run();
