<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Product extends BaseController
{
    protected $ProductModel;
    public function __construct()
    {
        $this->ProductModel = new \App\Models\ProductModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Product',
            'dataProduk' => $this->ProductModel->findAll()
        ];
        return view('admin/produk/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Product',
        ];
        return view('admin/produk/tambah', $data);
    }

    public function prosesTambah()
    {
        $rules = $this->validate([
            'product_code' => [
                'rules' => 'required|is_unique[products.product_code]',
                'errors' => [
                    'required' => 'Kode Produk harus diisi',
                    'is_unique' => 'Kode Produk sudah ada'
                ]
            ],
            'product_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi'
                ]
            ],
            'currency' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mata Uang harus diisi'
                ]
            ],
            'discount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diskon harus diisi'
                ]
            ],
            'dimension' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dimensi harus diisi'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi'
                ]
            ],
            'stock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok harus diisi'
                ]
            ]
        ]);

        if (!$rules) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to('/admin/produk/tambah')->withInput();
        }

        $data = [
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $this->request->getVar('product_name'),
            'price' => $this->request->getVar('price'),
            'currency' => $this->request->getVar('currency'),
            'discount' => $this->request->getVar('discount'),
            'dimension' => $this->request->getVar('dimension'),
            'unit' => $this->request->getVar('unit'),
            'stock' => $this->request->getVar('stock'),
        ];

        $this->ProductModel->insert($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan');
        return redirect()->to('/admin/produk');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Product',
            'produk' => $this->ProductModel->find($id)

        ];
        return view('admin/produk/edit', $data);
    }

    public function prosesEdit()
    {
        $rules = $this->validate([
            'product_code' => [
                'rules' => 'required|is_unique[products.product_code,id,' . $this->request->getVar('id') . ']',
                'errors' => [
                    'required' => 'Kode Produk harus diisi',
                    'is_unique' => 'Kode Produk sudah ada'
                ]
            ],
            'product_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Produk harus diisi'
                ]
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harga harus diisi'
                ]
            ],
            'currency' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mata Uang harus diisi'
                ]
            ],
            'discount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Diskon harus diisi'
                ]
            ],
            'dimension' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Dimensi harus diisi'
                ]
            ],
            'unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Satuan harus diisi'
                ]
            ],
            'stock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok harus diisi'
                ]
            ]
        ]);

        $id = $this->request->getVar('id');

        if (!$rules) {
            session()->setFlashdata('errors', $this->validator->listErrors());
            return redirect()->to('/admin/produk/edit/' . $id)->withInput();
        }

        $data = [
            'product_code' => $this->request->getVar('product_code'),
            'product_name' => $this->request->getVar('product_name'),
            'price' => $this->request->getVar('price'),
            'currency' => $this->request->getVar('currency'),
            'discount' => $this->request->getVar('discount'),
            'dimension' => $this->request->getVar('dimension'),
            'unit' => $this->request->getVar('unit'),
            'stock' => $this->request->getVar('stock'),
        ];

        $this->ProductModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil diubah');
        return redirect()->to('/admin/produk');

    }

    public function delete($id)
    {
        $this->ProductModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/admin/produk');
    }
}