<?php

namespace app\models;

use lib\MemCache;

class Phone extends BaseModel
{
  const PATTERN = '/\+7\d{10}/';

  public $phone;

  public function populate($post)
  {
    if (empty($_POST['phone'])) {
      $this->addError('Phone is empty');

      return false;
    }

    $this->phone = $_POST['phone'];

    return true;
  }

  public function validate()
  {
    if (false === preg_match(self::PATTERN, $this->phone)) {
      $this->addError('Invalid phone format');

      return false;
    }

    return true;
  }

  public function getPhone()
  {
    return $this->phone;
  }

  public function saveToSent($duration)
  {
    return MemCache::inst()->set($this->phone, '1', $duration);
  }

  public function findInSent()
  {
    return false !== MemCache::inst()->get($this->phone);
  }
}
