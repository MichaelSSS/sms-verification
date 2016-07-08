<?php

namespace app\controllers;

use app\models\Phone;
use app\models\Code;
use app\models\SMS;
use app\models\Stats;

class VerifyCodeController extends BaseController
{
  public function run()
  {
    $code = new Code;

    if (!$code->populate($_POST)) {
      $this->render([
        'status' => 0,
        'error'=> 'Invalid request'
      ]);
    }
    if (!$code->validate()) {
      Stats::storeVerification($code, 0);

      $this->render([
        'status' => 0,
        'error'=> $code->getError()
      ]);
    }

    Stats::storeVerification($code, 1);

    $this->render([
      'status' => 1,
      'error'=> null
    ]);
  }
}
