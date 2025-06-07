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
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->bukuModel->getBuku()
        ];
        return view('books/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku "' . $slug . '" tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Buku',
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
                    'required' => 'Judul harus diisi',
                    'is_unique' => 'Judul sudah dimasukkan'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penulis harus diisi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penerbit harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'File yang dipilih bukan gambar',
                    'mime_in' => 'Format gambar tidak sesuai (jpg/jpeg/png)'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/books/create')->withInput()->with('validation', $validation);
        }

        // ambil file gambar
        $gambarSampul = $this->request->getFile('sampul');

        // cek apakah tidak ada gambar yang di-upload
        if ($gambarSampul->getError() == 4) {
            $namaSampul = 'no-cover.jpg';
        } else {
            $namaSampul = $gambarSampul->getRandomName();
            $gambarSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
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

    public function update($id)
    {
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));

        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul buku harus diisi',
                    'is_unique' => 'Judul buku sudah ada'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $gambarSampul = $this->request->getFile('sampul');

        if ($gambarSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $gambarSampul->getRandomName();
            $gambarSampul->move('img', $namaSampul);

            // Hapus file lama jika ada dan bukan default
            $fileLama = 'img/' . $this->request->getVar('sampulLama');
            if ($this->request->getVar('sampulLama') != 'no-cover.jpg' && file_exists($fileLama)) {
                unlink($fileLama);
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if ($buku['sampul'] != 'no-cover.jpg') {
            $filePath = 'img/' . $buku['sampul'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/books');
    }
}