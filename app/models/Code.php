<?php

namespace app\models;

use lib\MemCache;

class Code extends BaseModel
{
  public $token;
  public $code;

  public function generate()
  {
    $this->token = uniqid();
    $this->code = sprintf('%04d', mt_rand(1, 9999));
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getToken()
  {
    return $this->token;
  }

  public function save()
  {
    if (!isset($this->token)) $this->generate();

    return MemCache::inst()->set($this->token, $this->code);
  }

  public function populate($post)
  {
    if (!$post) return false;
    $this->token = $post['token'];
    $this->code = $post['code'];
    return true;
  }

  public function validate()
  {
    $code = MemCache::inst()->get($this->token);

    if (!$code) {
      $this->addError('Invalid token');
      return false;
    }

    if ($code != $this->code) {
      $this->addError('Invalid code');
      return false;
    }

    return true;
  }
}
