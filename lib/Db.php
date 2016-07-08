<?php

namespace lib;

use app\Application;

class Db
{
  protected static $_inst;

  protected $_pdo;

  protected function __construct()
  {
    $config = Application::inst()->getConfig();

    $dbname = $config['db']['dbname'];
    $host = $config['db']['host'];
    $user = $config['db']['username'];
    $password = $config['db']['password'];

    $dsn = "mysql:dbname=$dbname;host=$host";

    $this->_pdo = new \PDO($dsn, $user, $password);
  }

  public static function inst()
  {
    if (!self::$_inst) {
      return self::$_inst = new self();
    }
    return self::$_inst;
  }

  public function db()
  {
    return $this->_pdo;
  }
}
