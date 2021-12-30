<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\Cast;

class ProductModel extends Model
{
  protected $table = 'products';
  protected $primaryKey = 'id_product';
  protected $useTimestamps = true;
  protected $allowedFields = ['id_game', 'denomination', 'price', 'reseller_price', 'stock', 'updated_by'];

  public function getProducts($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id_product' => $id])->first();
  }

  public function getProductId($denomination)
  {
    return $this->where(['denomination' => $denomination])->first();
  }


  public function getProductName($slug = false)
  {
    if ($slug == false) {
      $db = \Config\Database::connect();
      $builder = $db->table('products');
      $builder->select('*, CAST(denomination as SIGNED) AS casted_column', false);
      $builder->join('game_list',  'game_list.id_game = products.id_game');
      $builder->orderBy('game_name', 'ASC');
      $builder->orderBy('casted_column', 'ASC');
      $builder->orderBy('denomination', 'ASC');
      $query = $builder->get()->getResultArray();
      return $query;
    } else {
      $db = \Config\Database::connect();
      $builder = $db->table('products');
      $builder->select('*, CAST(denomination as SIGNED) AS casted_column', false);
      $builder->join('game_list',  'game_list.id_game = products.id_game')->where('slug', $slug);
      $builder->orderBy('casted_column', 'ASC');
      $builder->orderBy('denomination', 'ASC');
      $query = $builder->get()->getResultArray();
      return $query;
    }
  }
}
