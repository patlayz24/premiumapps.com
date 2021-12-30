<?php

namespace App\Models;

use CodeIgniter\Model;

class ResellerModel extends Model
{
  protected $table = 'reseller';
  protected $primaryKey = 'id_reseller';
  protected $useTimestamps = true;
  protected $allowedFields = ['full_name', 'email', 'password', 'phone', 'address', 'status', 'token', 'last_login_at', 'updated_by'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpddate = ['beforeUpdate'];

  public function getUsers($id_reseller = false)
  {
    if ($id_reseller == false) {
      return $this->findAll();
    }
    return $this->where(['id_reseller' => $id_reseller])->first();
  }


  protected function beforeInsert(array $data)
  {
    $data = $this->passwordHash($data);
    return $data;
  }

  protected function beforeUpdate(array $data)
  {
    $data = $this->passwordHash($data);
    return $data;
  }

  public function verifyEmail($email)
  {
    return $this->where(['email' => $email])->first();
  }

  public function verifyToken($token)
  {
    return $this->where(['token' => $token])->first();
  }

  protected function passwordHash(array $data)
  {
    if (isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    return $data;
  }
}
