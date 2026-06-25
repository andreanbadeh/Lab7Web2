<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';

        $model = new ArtikelModel();
        $artikel = $model->getArtikelDenganKategori();

        return view('artikel/index', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';

        $model = new ArtikelModel();

        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;

        $builder = $model->table('artikel')
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

        // pencarian judul
        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }

        // filter kategori
        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // pagination
        $artikel = $builder->paginate(10, 'default', $page);

        $pager = $model->pager;

        $data = [
            'title' => $title,
            'q' => $q,
            'kategori_id' => $kategori_id,
            'artikel' => $artikel,
            'pager' => $pager
        ];

        // cek apakah request AJAX
        if ($this->request->isAJAX()) {

            return $this->response->setJSON($data);

        } else {

            $kategoriModel = new KategoriModel();

            $data['kategori'] = $kategoriModel->findAll();

            return view('artikel/admin_index', $data);
        }
    }

    public function view($slug)
    {
        $model = new ArtikelModel();

        $artikel = $model->where([
            'slug' => $slug
        ])->first();

        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];

        return view('artikel/detail', compact('artikel', 'title'));
    }

    public function add()
    {
        // validasi
        $validation = \Config\Services::validation();

        $validation->setRules([
            'judul' => 'required',
            'id_kategori' => 'required|integer'
        ]);

        $isDataValid = $validation
            ->withRequest($this->request)
            ->run();

        if ($isDataValid) {

            $file = $this->request->getFile('gambar');

            // upload gambar
            if ($file && $file->isValid() && !$file->hasMoved()) {

                $file->move(ROOTPATH . 'public/gambar');

                $namaFile = $file->getName();

            } else {

                $namaFile = null;
            }

            $artikel = new ArtikelModel();

            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title(
                    $this->request->getPost('judul'),
                    '-',
                    true
                ),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'gambar' => $namaFile,
            ]);

            return redirect()->to('/admin/artikel');
        }

        $kategoriModel = new KategoriModel();

        $data = [
            'title' => 'Tambah Artikel',
            'kategori' => $kategoriModel->findAll()
        ];

        return view('artikel/form_add', $data);
    }

    public function edit($id)
    {
        $model = new ArtikelModel();

        if (
            $this->request->getMethod() == 'post'
            && $this->validate([
                'judul' => 'required',
                'id_kategori' => 'required|integer'
            ])
        ) {

            $file = $this->request->getFile('gambar');

            // jika upload gambar baru
            if ($file && $file->isValid() && !$file->hasMoved()) {

                $file->move(ROOTPATH . 'public/gambar');

                $namaFile = $file->getName();

                $dataUpdate = [
                    'judul' => $this->request->getPost('judul'),
                    'isi' => $this->request->getPost('isi'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'gambar' => $namaFile,
                ];

            } else {

                $dataUpdate = [
                    'judul' => $this->request->getPost('judul'),
                    'isi' => $this->request->getPost('isi'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                ];
            }

            $model->update($id, $dataUpdate);

            return redirect()->to('/admin/artikel');
        }

        $kategoriModel = new KategoriModel();

        $data = [
            'title' => 'Edit Artikel',
            'artikel' => $model->find($id),
            'kategori' => $kategoriModel->findAll()
        ];

        return view('artikel/form_edit', $data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();

        $model->delete($id);

        return redirect()->to('/admin/artikel');
    }
}