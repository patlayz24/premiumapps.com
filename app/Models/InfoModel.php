<?php

namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model
{
  protected $table = 'information';
  protected $useTimestamps = true;
  protected $allowedFields = ['info', 'updated_by'];

  public function getInformations($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
}
