<?php

namespace App\Models;

use CodeIgniter\Model;

class BrochureModel extends Model
{
  protected $table = 'brochures';
  protected $useTimestamps = true;
  protected $allowedFields = ['brochure_name', 'desc', 'thumbnail', 'updated_by'];

  public function getBrochures($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
}
