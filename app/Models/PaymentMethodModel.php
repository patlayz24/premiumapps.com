<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
  protected $table = 'payment_method';
  protected $useTimestamps = true;
  protected $allowedFields = ['category', 'bank_name', 'account_name', 'account_number', 'admin_fee', 'thumbnail', 'logo', 'updated_by'];

  public function getPaymentMethods($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
}
