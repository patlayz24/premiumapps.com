<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_reseller', 'id_game', 'user_id', 'denomination', 'quantity', 'price', 'total', 'payment_method', 'contact', 'status', 'confirm_by', 'process_by'];

    public function getReport($id = false)
    {
        if ($id == false) {
            $db = \Config\Database::connect();
            $builder = $db->table('game_list');
            $where = "status = 'Ditolak' OR status = 'Selesai' ";
            $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where($where);
            $query = $builder->get()->getResultArray();
            return $query;
        } else {
            $db = \Config\Database::connect();
            $builder = $db->table('game_list');
            $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where('id_transaction', $id);
            $query = $builder->get()->getRowArray();
            return $query;
        }
    }

    public function getReportReseller()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('game_list');
        $where = "id_reseller =" . session('id_reseller') . " AND (status = 'Ditolak' OR status = 'Selesai')";
        $builder->select('*')->join('transactions',  'game_list.id_game = transactions.id_game')->where($where);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getCountedData()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $where = " status ='Ditolak' OR status = 'Selesai'";
        $builder->selectCount('id_transaction')->where($where);
        $query = $builder->get()->getRowArray();
        return $query;
    }

    public function getTurnOver()
    {

        $date = date('Y-m-d');
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $where = "status = 'Selesai' AND created_at LIKE '%$date%'";
        $builder->selectSum('total')->where($where);
        $query = $builder->get()->getRowArray();
        return $query;
    }

    public function successTransaction()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $builder->selectCount('id_transaction')->where('status', 'Selesai');
        $query = $builder->get()->getRowArray();
        return $query;
    }

    public function weekReport()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $where = "status = 'Selesai' AND created_at > now() - INTERVAL 7 day";
        $builder->select('DATE(created_at) AS date,SUM(total) AS turnover', false);
        $builder->where($where);
        $builder->groupBy('date');
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function popularProduct()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transactions');
        $builder->select('game_name, SUM(quantity) AS TotalQuantity', false)->join('game_list',  'game_list.id_game = transactions.id_game');
        $builder->groupBy('game_name')->orderBy('TotalQuantity')->limit(3);
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
