<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
  protected $table = 'transactions';
  protected $primaryKey = 'id_transaction';
  protected $useTimestamps = true;
  protected $allowedFields = ['transaction_number', 'id_reseller', 'id_game', 'user_id', 'denomination', 'quantity', 'price', 'random', 'total', 'payment_method', 'contact', 'voucher', 'status', 'confirm_by', 'process_by', 'created_at'];

  public function getTransactions($id = false)
  {
    if ($id == false) {
      return $this->findAll();
    }
    return $this->where(['id_transaction' => $id])->first();
  }

  public function getTransactionsByNumber($trxNumber = false)
  {
    return $this->where(['transaction_number' => $trxNumber])->first();
  }

  public function getData($trxNumber = false)
  {
    if ($trxNumber == false) {
      $db = \Config\Database::connect();
      $builder = $db->table('game_list');
      $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game');
      $query = $builder->get()->getResultArray();

      return $query;
    }
    $db = \Config\Database::connect();
    $builder = $db->table('game_list');
    $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where('transaction_number', $trxNumber);
    $query = $builder->get()->getRowArray();
    return $query;
  }

  public function getDataReseller()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('game_list');
    $where = "status = 'Diproses' OR status = 'Terkonfirmasi' AND id_reseller =" . session('id_reseller');
    $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where($where);
    $query = $builder->get()->getResultArray();

    return $query;
  }

  public function getPaymentData()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('game_list');
    $where = "status = 'Terkonfirmasi ' OR status = 'Menunggu Konfirmasi'";
    $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where($where);
    $query = $builder->get()->getResultArray();
    return $query;
  }

  public function getProsesData()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('game_list');
    $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game', 'inner')->where('status', 'Diproses');
    $query = $builder->get()->getResultArray();
    return $query;
  }

  public function getCountedData()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('transactions');
    $where = "status = 'Diproses' OR status = 'Menunggu Konfirmasi' OR status = 'Terkonfirmasi'";
    $builder->selectCount('id_transaction')->where($where);
    $query = $builder->get()->getRowArray();
    return $query;
  }
}
