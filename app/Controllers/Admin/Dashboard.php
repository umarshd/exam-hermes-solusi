<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $UserModel;
    protected $ProductModel;
    protected $TransactionHeaderModel;

    public function __construct()
    {
        $this->UserModel = new \App\Models\UsersModel();
        $this->ProductModel = new \App\Models\ProductModel();
        $this->TransactionHeaderModel = new \App\Models\TransactionHeaderModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'countUser' => $this->UserModel->countAllResults() - 1,
            'countProduct' => $this->ProductModel->countAllResults(),
            'countTransaction' => $this->TransactionHeaderModel->countAllResults()
        ];
        return view('admin/dashboard', $data);
    }
}