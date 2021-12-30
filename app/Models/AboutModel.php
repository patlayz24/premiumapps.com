<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
  protected $table = 'about';
  protected $useTimestamps = true;
  protected $allowedFields = ['about', 'promotion', 'tnc', 'updated_by'];

  public function getAbouts($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
}
