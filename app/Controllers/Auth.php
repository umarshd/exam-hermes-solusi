<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UsersModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];
        return view('auth', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }

    public function prosesLogin()
    {
        $rules = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi'
                ]
            ]
        ]);


        if (!$rules) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('/')->withInput();
        }

        $email = $this->request->getVar('email');

        $password = $this->request->getVar('password');

        $user = $this->UserModel->where('email', $email)->first();

        if (!$user) {
            session()->setFlashdata('error', ['Email atau password salah']);
            return redirect()->to('/')->withInput();
        }

        if (!password_verify($password, $user['password'])) {
            session()->setFlashdata('error', ['Email atau password salah']);
            return redirect()->to('/')->withInput();
        }

        $data = [
            'user_id' => $user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
            'logged_in' => TRUE
        ];

        session()->set($data);

        if ($user['role'] == 'admin') {
            return redirect()->to('/admin');
        } else {
            return redirect()->to('/user');
        }

    }

    public function prosesRegister()
    {
        $rules = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi',
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ],
            'password_confirm' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi',
                    'matches' => 'Konfirmasi password tidak sesuai'
                ]
            ],
        ]);

        if (!$rules) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('/register')->withInput();
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        $this->UserModel->insert($data);

        session()->setFlashdata('success', 'Register berhasil, silahkan login');

        return redirect()->to('/');
    }
}