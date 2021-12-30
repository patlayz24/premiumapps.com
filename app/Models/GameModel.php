<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
  protected $table = 'game_list';
  protected $primaryKey = 'id_game';
  protected $useTimestamps = true;
  protected $allowedFields = ['game_name', 'desc', 'thumbnail', 'slug', 'updated_by'];

  public function getGames($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id_game' => $id])->first();
  }

  public function getGameSlug($slug = false)
  {
    if ($slug == false) {
      return $this->findAll();
    }
    return $this->where(['slug' => $slug])->first();
  }
}
