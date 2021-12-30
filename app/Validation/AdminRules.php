<?php

namespace App\Validation;

use App\Models\AdminModel;

class AdminRules
{
  public function validateAdmin(string $str, string $fields, array $data)
  {
    $model = new AdminModel();
    $user = $model->where('email', $data['email'])->first();

    if (!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }
}
