<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $adminModel;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Users',
            'users' => $this->adminModel->getUsers(),
            'request' => \Config\Services::request(),
        ];
        return view('admin/user', $data);
    }

    public function register()
    {
        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'full_name' => 'required|min_length[3]|max_length[30]',
                'phone' => 'required|min_length[3]|max_length[30]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[admin.email]',
                'address' => 'required|min_length[8]|max_length[255]',
                'password' => 'required|min_length[8]|max_length[255]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('admin/user');
            } else {
                $newData = [
                    'full_name' => htmlspecialchars($this->request->getVar('full_name')),
                    'email' => htmlspecialchars($this->request->getVar('email')),
                    'phone' => htmlspecialchars($this->request->getVar('phone')),
                    'address' => htmlspecialchars($this->request->getVar('address')),
                    'status' => 0,
                    'role' => htmlspecialchars($this->request->getVar('2')),
                    'password' => htmlspecialchars($this->request->getVar('password')),
                    'updated_by' => session('full_name'),
                ];
                $this->adminModel->save($newData);
                session()->setFlashdata('success', 'Data berhasil ditambah.');
                return redirect()->to(base_url('admin/user'));
            }
        }
    }

    public function setActive($id)
    {
        if ($this->request->getMethod() == 'put') {
            $this->adminModel->save([
                'id' => $id,
                'status' => htmlspecialchars($this->request->getVar('setactive')),
                'updated_by' => session()->get('full_name'),
            ]);
            session()->setFlashdata('success', 'Data berhasil diubah.');
            return redirect()->to(base_url('admin/user'));
        }
    }

    public function detail($id)
    {
        $data = [
            'user' => $this->adminModel->getUsers($id),
        ];
        return view('admin/modal/detail/detailuser', $data);
    }

    public function deleteAdmin($id)
    {
        if ($this->request->getMethod() == 'delete') {
            $this->adminModel->delete($id);
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/user'));
        }
    }
}
