<?php

namespace app\models;

use app\Application;

class SMS extends BaseModel
{
  const URL_TEMPLATE = 'http://smsc.ru/sys/send.php?login=%s&psw=%s&phones=%s&mes=%s';

  private $_login;
  private $_password;

  public function __construct()
  {
    $config = Application::inst()->getConfig();
    $this->_login = $config['sms']['login'];
    $this->_password = $config['sms']['password'];
  }

  public function send($phone, $message)
  {
    $url = sprintf(self::URL_TEMPLATE, $this->_login, $this->_password, $phone, $message);
echo $url . PHP_EOL; return true;
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_POST, 1);

    $result = curl_exec($ch);

    curl_close($ch);

    return false === strpos($result, 'ERROR');
  }
}
