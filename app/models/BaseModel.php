<?php

namespace app\models;

class BaseModel
{
  protected $error;

  public function addError($error)
  {
    $this->error = $error;
  }

  public function getError()
  {
    return $this->error;
  }
}
