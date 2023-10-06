<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UsersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'User',
            'dataUser' => $this->UserModel->findAll()
        ];
        return view('admin/user/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('admin/user/tambah', $data);
    }

    public function prosesTambah()
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
        ]);

        if (!$rules) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('/admin/user/tambah')->withInput();
        }

        if ($this->request->getVar('password') != $this->request->getVar('password_konfirmasi')) {
            session()->setFlashdata('error', 'Password tidak sama');
            return redirect()->to('/admin/user/tambah')->withInput();
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        $this->UserModel->insert($data);

        session()->setFlashdata('success', 'User berhasil ditambahkan');

        return redirect()->to('/admin/user');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->UserModel->find($id)
        ];
        return view('admin/user/edit', $data);
    }

    public function prosesEdit()
    {
        $rules = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email,id,' . $this->request->getVar('id') . ']',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
        ]);

        $id = $this->request->getVar('id');

        if (!$rules) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('/admin/user/' . $id . '/edit')->withInput();
        }

        $password = $this->request->getVar('password');

        if ($password) {
            if ($password != $this->request->getVar('password_konfirmasi')) {
                session()->setFlashdata('error', 'Password tidak sama');
                return redirect()->to('/admin/user/' . $id . '/edit')->withInput();
            }

            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
        } else {
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email')
            ];
        }


        $this->UserModel->update($id, $data);

        session()->setFlashdata('success', 'User berhasil diedit');

        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);

        session()->setFlashdata('success', 'User berhasil dihapus');

        return redirect()->to('/admin/user');
    }
}