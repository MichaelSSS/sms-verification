<?php

namespace app;

use app\controllers\GetCodeController;
use app\controllers\VerifyCodeController;

class Application
{
  protected static $_inst;

  protected $_config;

  protected function __construct()
  {
  }

  public static function inst()
  {
    if (!self::$_inst) {
      self::$_inst = new self();
    }
    return self::$_inst;
  }

  public function init($config)
  {
    $this->_config = $config;
  }

  public function run()
  {
    if (isset($_GET['getcode'])) {
      (new GetCodeController)->run();
    } elseif (isset($_GET['verifycode'])) {
      (new VerifyCodeController)->run();
    }
  }

  public function getConfig()
  {
    return $this->_config;
  }
}
