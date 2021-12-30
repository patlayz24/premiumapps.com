<?php

namespace App\Controllers\Auth;

use App\Models\AboutModel;
use App\Models\AdminModel;
use App\Models\SocialModel;
use App\Controllers\BaseController;

class Admin extends BaseController
{
    protected $adminModel;
    protected $socialModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->aboutModel = new AboutModel();
        $this->socialModel = new SocialModel();
    }

    public function index()
    {
        $data = [
            'about' => $this->aboutModel->getAbouts(1),
            'title' => 'Admin Login - Kota Digital',
            'socials' => $this->socialModel->getSocials(),
            'validation' => \Config\Services::validation(),
        ];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateAdmin[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateAdmin' => 'Email or Password don\'t match'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                return redirect()->to(base_url('/adminlogin'))->withInput();
            } else {
                $user = $this->adminModel->where('email', $this->request->getVar('email'))->first();
                if ($user['status'] == '1') {
                    $this->setUserSession($user);
                    return redirect()->to(base_url('/admin'));
                }
                return redirect()->to(base_url('/adminlogin'))->withInput();
            }
        }
        return view('auth/admin', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'isLoggedInAdmin' => true,
        ];
        session()->set($data);
        return true;
    }

    public function detailUser()
    {
        $data = [
            'user' => $this->adminModel->getUsers(session('id')),
            'request' => \Config\Services::request(),
            'title' => 'Detail User',
        ];
        return view('admin/profile/index', $data);
    }

    public function editProfile()
    {
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'full_name' => 'required|min_length[3]|max_length[30]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to('/admin/profile')->withInput();
            } else {
                $newData = [
                    'id' => session()->get('id'),
                    'full_name' => htmlspecialchars($this->request->getVar('full_name')),
                    'phone' => htmlspecialchars($this->request->getVar('phone')),
                    'address' => htmlspecialchars($this->request->getVar('address')),
                    'updated_by' => $this->request->getVar('firstname'),
                ];
                $this->adminModel->save($newData);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('admin/user/detailuser'));
            }
        }
    }

    public function editPassword()
    {
        $data = [
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::validation(),
            'request' => \Config\Services::request(),
            'title' => 'Change Password',
        ];
        if ($this->request->getMethod() == 'put') {
            $rules = [
                'oldpassword' => 'required|min_length[6]|max_length[255]',
                'password' => 'required|min_length[6]|max_length[255]',
                'confirmpassword' => 'required|matches[password]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                session()->setFlashdata('error', $data['validation']->listErrors());
                return redirect()->to(base_url('admin/user/change-password'));
            } else {
                $currentPassword = $this->request->getVar('oldpassword');
                $newPassword = $this->request->getVar('password');
                $dataUser = $this->adminModel->getUsers(session('id'));

                if (!password_verify($currentPassword, $dataUser['password'])) {
                    $data['validation'] = $this->validator;
                    session()->setFlashdata('danger', 'Password salah');
                    return redirect()->to(base_url('admin/user/change-password'));
                } else {
                    if ($currentPassword == $newPassword) {
                        $data['validation'] = $this->validator;
                        session()->setFlashdata('danger', 'Password lama dan password baru tidak boleh sama!.');
                        echo 'Password lama dan password baru tidak boleh sama!.';
                        return redirect()->to(base_url('admin/user/change-password'));
                    } else {
                        $newData = [
                            'id' => session()->get('id'),
                            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        ];
                        $this->adminModel->save($newData);
                        session()->setFlashdata('success', 'Password berhasil diubah');
                        return redirect()->to(base_url('admin/user/change-password'));
                    }
                }
            }
        }
        return view('admin/profile/changepassword', $data);
    }

    public function forgetPassword()
    {
        $data = [
            'title' => 'Lupa password',
            'validation' => \Config\Services::validation(),
        ];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' =>
                [
                    'label' => 'Email',
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => '{field} wajib di isi',
                        'valid_email' => 'Gunakan {field} yang benar!'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getVar('email', FILTER_SANITIZE_EMAIL);
                $userData = $this->adminModel->verifyEmail($email);
                if (!empty($userData)) {
                    helper('text');
                    $to = $email;
                    $subject = 'Reset Password';
                    $token = random_string('alnum', 64);
                    $message = 'Hi ' . $userData['full_name'] . '<br><br>'
                        . 'Your reset password request has been received. Please click'
                        . 'the below link to reset your password. <br><br>'
                        . '<a href="' . base_url('/changepassword-admin') . '/' . $token  . '">Click here to reset password</a><br><br>'
                        . 'Thanks';
                    $this->adminModel->save([
                        'id' => $userData['id'],
                        'token' => $token
                    ]);
                    $email = \Config\Services::email();
                    $email->setFrom('franky.utomo91@gmail.com', 'Franky');
                    $email->setTo($to);
                    $email->setSubject($subject);
                    $email->setMessage($message);
                    if ($email->send()) {
                        session()->setFlashdata('success', 'Reset password link sent to your email.');
                        return redirect()->to(base_url('forgetpassword-admin'));
                    }
                } else {
                    session()->setFlashdata('danger', 'Email belum terdaftar.');
                    return redirect()->to(base_url('forgetpassword-admin'))->withInput();
                }
            }
            session()->setFlashdata('danger', 'Error.');
            return redirect()->to(base_url('forgetpassword-admin'))->withInput();
        }
        return view('auth/forgetpassword-admin', $data);
    }

    public function changePassword($token = null)
    {
        helper(['form']);
        if (empty($token)) {
            return redirect()->to(base_url('forgetpassword-admin'));
        }
        if (!$data['user'] = $this->adminModel->verifyToken($token)) {
            return redirect()->to(base_url('forgetpassword-admin'));
        }
        $data = [
            'title' => 'Change Password',
            'validation' => \Config\Services::validation(),
        ];
        $data['user'] = $this->adminModel->verifyToken($token);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => 'required|min_length[6]|max_length[255]',
                'confirm_password' => 'required|matches[password]|min_length[6]|max_length[255]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                return redirect()->to(base_url('changepassword-admin') . '/' . $data['user']['token'])->withInput();
            } else {
                $newData = [
                    'id' => $data['user']['id'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'token' => 'kosong',
                ];
                $this->adminModel->save($newData);
                session()->setFlashdata('success', 'password berhasil diubah');
                return redirect()->to(base_url('adminlogin'));
            }
        } else {
            return view('auth/changepassword-admin', $data);
        }
    }

    public function logoutAdmin()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}