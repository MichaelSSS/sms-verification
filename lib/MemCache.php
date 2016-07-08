<?php

namespace lib;

use app\Application;

class MemCache
{
  protected static $_inst;
  protected $_cache;

  protected function __construct()
  {
    $this->_cache = new \Memcache;

    $config = Application::inst()->getConfig();

    foreach ($config['cache']['servers'] as $server) {
      $this->_cache->addServer($server['host'], $server['port']);
    }
  }

  public static function inst()
  {
    if (!self::$_inst) {
      return self::$_inst = new self();
    }
    return self::$_inst;
  }

  public function set($key, $value, $expiration = 0, $flags = 0)
  {
    return $this->_cache->set($key, $value, $flags, $expiration);
  }

  public function get($key)
  {
    return $this->_cache->get($key);
  }
}
