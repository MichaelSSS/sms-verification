<?php

namespace app\models;

use lib\Db;
use app\models\Phone;
use app\models\Code;

class Stats
{
  public static function storeSending(Phone $phone, Code $code)
  {
    $sth = Db::inst()->db()->prepare(
      'INSERT INTO `sendings` (`token`, `phone`, `created_at`)
       VALUES (:token, :phone, NOW())'
    );

    return $sth->execute([':token' => $code->getToken(), ':phone' => $phone->getPhone()]);
  }

  public static function storeVerification(Code $code, $status)
  {
    $sth = Db::inst()->db()->prepare(
      'INSERT INTO `verifications` (`token`, `status`, `created_at`)
       VALUES (:token, :status, NOW())'
    );

    return $sth->execute([':token' => $code->getToken(), ':status' => $status]);
  }
}
