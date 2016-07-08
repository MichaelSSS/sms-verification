<?php

namespace app\controllers;

class BaseController
{
  protected function renderError($error)
  {
    $this->render(['error' => $error]);
  }

  protected function render($data)
  {
    $data['ruid'] = $this->getRuid();
    echo json_encode($data) . PHP_EOL;

    exit;
  }

  protected function getRuid()
  {
    return $_POST['ruid'];
  }
}
