<?php

namespace App\Models;

use CodeIgniter\Model;

class SocialModel extends Model
{
  protected $table = 'social';
  protected $useTimestamps = true;
  protected $allowedFields = ['social_media', 'url', 'a_class', 'icon_class', 'username', 'updated_by'];

  public function getSocials($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id' => $id])->first();
  }
}
