<?php

namespace App\Controllers\Auth;

use App\Models\AboutModel;
use App\Models\ResellerModel;
use App\Controllers\BaseController;
use App\Models\SocialModel;

class Reseller extends BaseController
{
    protected $resellerModel;
    protected $socialModel;
    public function __construct()
    {
        $this->resellerModel = new ResellerModel();
        $this->aboutModel = new AboutModel();
        $this->socialModel = new SocialModel();
    }

    public function index()
    {
        $data = [
            'about' => $this->aboutModel->getAbouts(1),
            'title' => 'Reseller Login - Kota Digital',
            'socials' => $this->socialModel->getSocials(),
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::validation(),
        ];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateReseller[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateReseller' => 'Email or Password don\'t match'
                ]
            ];
            if (!$this->validate($rules, $errors)) {
                return redirect()->to(base_url('/resellerlogin'))->withInput();
            } else {
                $reseller = $this->resellerModel->where('email', $this->request->getVar('email'))->first();
                if ($reseller['status'] == '1') {
                    $this->setUserSession($reseller);
                    return redirect()->to(base_url('/reseller'));
                }
                return redirect()->to(base_url('/resellerlogin'))->withInput();
            }
        }
        return view('auth/login', $data);
    }

    private function setUserSession($reseller)
    {
        $data = [
            'id_reseller' => $reseller['id_reseller'],
            'name_reseller' => $reseller['full_name'],
            'email_reseller' => $reseller['email'],
            'isLoggedInReseller' => true,
        ];
        session()->set($data);
        return true;
    }

    public function detailUser()
    {
        $data = [
            'request' => \Config\Services::request(),
            'user' => $this->resellerModel->getUsers(session('id_reseller')),
        ];
        return view('reseller/profile/index', $data);
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
                return redirect()->to(base_url('reseller/detailuser'))->withInput();
            } else {
                $newData = [
                    'id_reseller' => session()->get('id_reseller'),
                    'full_name' => htmlspecialchars($this->request->getVar('full_name')),
                    'phone' => htmlspecialchars($this->request->getVar('phone')),
                    'address' => htmlspecialchars($this->request->getVar('address')),
                    'updated_by' => $this->request->getVar('full_name'),
                ];
                $this->resellerModel->save($newData);
                session()->setFlashdata('success', 'Data berhasil diubah');
                return redirect()->to(base_url('reseller/detailuser'));
            }
        }
    }

    public function editPassword()
    {
        $data = [
            'request' => \Config\Services::request(),
            'validation' => \Config\Services::validation(),
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
                return redirect()->to(base_url('reseller/change-password'));
            } else {
                $currentPassword = $this->request->getVar('oldpassword');
                $newPassword = $this->request->getVar('password');
                $dataUser = $this->resellerModel->getUsers(session('id_reseller'));

                if (!password_verify($currentPassword, $dataUser['password'])) {
                    $data['validation'] = $this->validator;
                    session()->setFlashdata('danger', 'Password salah');
                    return redirect()->to(base_url('reseller/change-password'));
                } else {
                    if ($currentPassword == $newPassword) {
                        $data['validation'] = $this->validator;
                        session()->setFlashdata('danger', 'Password lama dan password baru tidak boleh sama!.');
                        echo 'Password lama dan password baru tidak boleh sama!.';
                        return redirect()->to(base_url('reseller/change-password'));
                    } else {
                        $newData = [
                            'id_reseller' => session()->get('id_reseller'),
                            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                        ];
                        $this->resellerModel->save($newData);
                        session()->setFlashdata('success', 'Password berhasil diubah');
                        return redirect()->to(base_url('reseller/change-password'));
                    }
                }
            }
        }
        return view('reseller/profile/changepassword', $data);
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
                $userData = $this->resellerModel->verifyEmail($email);
                if (!empty($userData)) {
                    helper('text');
                    $to = $email;
                    $subject = 'Reset Password';
                    $token = random_string('alnum', 64);
                    $message = 'Hi ' . $userData['full_name'] . '<br><br>'
                        . 'Your reset password request has been received. Please click'
                        . 'the below link to reset your password. <br><br>'
                        . '<a href="' . base_url('/changepassword-reseller') . '/' . $token  . '">Click here to reset password</a><br><br>'
                        . 'Thanks';
                    $this->resellerModel->save([
                        'id_reseller' => $userData['id_reseller'],
                        'token' => $token
                    ]);
                    $email = \Config\Services::email();
                    $email->setFrom('franky.utomo91@gmail.com', 'Franky');
                    $email->setTo($to);
                    $email->setSubject($subject);
                    $email->setMessage($message);
                    if ($email->send()) {
                        session()->setFlashdata('success', 'Reset password link sent to your email.');
                        return redirect()->to(base_url('/forgetpassword-reseller'));
                    }
                } else {
                    session()->setFlashdata('danger', 'Email belum terdaftar.');
                    return redirect()->to(base_url('/forgetpassword-reseller'))->withInput();
                }
            }
            session()->setFlashdata('danger', 'Error.');
            return redirect()->to(base_url('/forgetpassword-reseller'))->withInput();
        }
        return view('auth/forgetpassword-reseller', $data);
    }

    public function changePassword($token = null)
    {
        helper(['form']);
        if (empty($token)) {
            return redirect()->to(base_url('/forgetpassword-reseller'));
        }
        if (!$data['user'] = $this->resellerModel->verifyToken($token)) {
            return redirect()->to(base_url('/forgetpassword-reseller'));
        }
        $data = [
            'title' => 'Change Password',
            'validation' => \Config\Services::validation(),
        ];
        $data['user'] = $this->resellerModel->verifyToken($token);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => 'required|min_length[6]|max_length[255]',
                'confirm_password' => 'required|matches[password]|min_length[6]|max_length[255]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
                return redirect()->to(base_url('/changepassword') . '/' . $data['user']['token'])->withInput();
            } else {
                $newData = [
                    'id_reseller' => $data['user']['id_reseller'],
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'token' => 'kosong',
                ];
                $this->resellerModel->save($newData);
                session()->setFlashdata('success', 'password berhasil diubah');
                return redirect()->to(base_url('/resellerlogin'));
            }
        } else {
            return view('auth/changepassword-reseller', $data);
        }
    }

    public function logoutReseller()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
