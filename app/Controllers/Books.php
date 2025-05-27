<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this->bukuModel = new BookModel();
    }
    public function index()
    {
        $buku = $this->bukuModel->findAll();
        $data =[
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->getBuku()
        ];
        return view('books/index', $data);
    }
    public function detail($slug)
    {
        //$buku = $this->bukuModel->where(['$slug' => $slug])->first();
        //$buku = $this->bukuModel->getKomik($slug); pindah ke data

        $data =[
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($slug)
        ];
        //jika buku tidak ada
        if (empty($data['buku'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku'. $slug. 'Tidak ditemukan');
        }
        return view('books/detail', $data);
    }
    public function create()
    {
        $data = [
            'title '=> 'Form Tamba Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('books/create', $data);
    }
    public function save()
{
    if (!$this->validate([
        'judul' => [
            'rules' => 'required|is_unique[books.judul]',
            'errors' => [
                'required' => '{field} buku harus diisi',
                'is_unique' => '{field} buku sudah dimasukkan'
            ]
        ]
    ])) {
        $validation = \Config\Services::validation();
        return redirect()->to(base_url() . '/books/create')->withInput()->with('validation', $validation);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->bukuModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,  // hapus spasi
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
    return redirect()->to('/books');
}

public function update($id)
{
    $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
    if ($bukuLama['judul'] == $this->request->getVar('judul')) {
        $rule_judul = 'required';
    } else {
        $rule_judul = 'required|is_unique[books.judul]';  // huruf kecil
    }

    if (!$this->validate([
        'judul' => [
            'rules' => $rule_judul,
            'errors' => [
                'required' => '{field} buku harus diisi',
                'is_unique' => '{field} buku sudah dimasukkan'
            ]
        ]
    ])) {
        $validation = \Config\Services::validation();
        return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
    }

    $slug = url_title($this->request->getVar('judul'), '-', true);
    $this->bukuModel->save([
        'id' => $id,
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah');
    return redirect()->to('/books');
}

public function delete($id)
{
    $this->bukuModel->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus');  // perbaiki Flasdata
    return redirect()->to('/books');
}

public function edit($slug)
{
    $data = [
        'title' => 'Form Ubah Data Buku',
        'validation' => \Config\Services::validation(),
        'buku' => $this->bukuModel->getBuku($slug)
    ];

    return view('books/edit', $data);
}


}