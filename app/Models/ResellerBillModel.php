<?php

namespace App\Models;

use CodeIgniter\Model;

class ResellerBillModel extends Model
{
  protected $table = 'reseller_bill';
  protected $primaryKey = 'transaction_number';
  protected $useTimestamps = true;
  protected $allowedFields = ['transaction_number', 'id_reseller', 'price', 'status', 'updated_by'];

  public function getBill()
  {
    return $this->findAll();
  }

  public function getIdReseller($id, $date)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('reseller_bill');
    $where = "created_at LIKE '%$date%' AND id_reseller = $id";
    $builder->select('*')->where($where);
    $query = $builder->get()->getRowArray();
    return $query;
  }

  public function insertBill($insert)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('reseller_bill');
    $builder->insert($insert);
  }

  public function updateBill($update, $date, $id_reseller, $trx_number)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('reseller_bill');
    $where = "transaction_number = $trx_number AND id_reseller = $id_reseller AND created_at LIKE '%$date% ";
    $builder->where($where);
    $builder->replace($update);
  }

  public function getAllBill()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('reseller');
    $builder->select('*')->join('reseller_bill',  'reseller.id_reseller = reseller_bill.id_reseller');
    $query = $builder->get()->getResultArray();
    return $query;
  }

  public function getResellerBill($id)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('reseller_bill');
    $builder->select('*')->where('id_reseller', $id);
    $query = $builder->get()->getResultArray();
    return $query;
  }
}
