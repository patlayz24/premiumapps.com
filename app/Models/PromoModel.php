<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
  protected $table = 'promo';
  protected $useTimestamps = true;
  protected $allowedFields = ['promo_name', 'promo_code', 'discount', 'stock', 'date_from', 'date_to', 'updated_by'];

  public function getPromo($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
  public function getPromoCode($code)
  {
    return $this->where(['promo_code' => $code])->first();
  }
}
