<?php

namespace App\Validation;

use App\Models\ResellerModel;

class ResellerRules
{
  public function validateReseller(string $str, string $fields, array $data)
  {
    $model = new ResellerModel();
    $user = $model->where('email', $data['email'])->first();

    if (!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }
}
