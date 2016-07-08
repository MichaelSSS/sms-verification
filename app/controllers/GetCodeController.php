<?php

namespace app\controllers;

use app\models\Phone;
use app\models\Code;
use app\models\SMS;
use app\models\Stats;

class GetCodeController extends BaseController
{
  public function run()
  {
    $phone = new Phone;

    if (!$phone->populate($_POST)) {
      $this->renderError('Invalid request');
    }
    if (!$phone->validate()) {
      $this->renderError($phone->getError());
    }
    if ($phone->findInSent()) {
      $this->renderError('Rate limit is exceeded');
    }

    $code = new Code;
    $code->generate();

    if (!$code->save()) {
      $this->renderError($code->getError());
    }

    $sms = new SMS;
    if (!$sms->send($phone->getPhone(), 'Code: ' . $code->getCode())) {
      $this->renderError($sms->getError());
    }

    Stats::storeSending($phone, $code);

    $phone->saveToSent(40);

    $this->render([
      'token' => $code->getToken()
    ]);
  }
}
