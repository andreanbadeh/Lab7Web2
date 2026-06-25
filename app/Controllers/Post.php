<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    protected $format = 'json';

    private function setCorsHeaders()
    {
        $this->response
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }

    public function options()
    {
        $this->setCorsHeaders();

        return $this->response
            ->setStatusCode(200)
            ->setBody('');
    }

    private function getInputData()
    {
        $json = $this->request->getJSON(true);

        if ($json) {
            return $json;
        }

        return [
            'judul'  => $this->request->getVar('judul'),
            'isi'    => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status'),
        ];
    }

    private function makeSlug($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');

        return $text ?: 'artikel';
    }

    public function index()
    {
        $this->setCorsHeaders();

        $model = new ArtikelModel();

        $data['artikel'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();

        return $this->respond($data);
    }

    public function create()
    {
        $this->setCorsHeaders();

        $model = new ArtikelModel();
        $input = $this->getInputData();

        $judul = $input['judul'] ?? '';
        $isi = $input['isi'] ?? '';
        $status = $input['status'] ?? 'draft';

        if ($judul === '' || $isi === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 400,
                    'error' => true,
                    'messages' => 'Judul dan isi artikel wajib diisi.'
                ]);
        }

        $data = [
            'judul'       => $judul,
            'isi'         => $isi,
            'status'      => $status,
            'slug'        => $this->makeSlug($judul),
            'gambar'      => null,
            'id_kategori' => null
        ];

        $model->insert($data);

        return $this->response
            ->setStatusCode(201)
            ->setJSON([
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data berhasil ditambahkan.'
                ]
            ]);
    }

    public function show($id = null)
    {
        $this->setCorsHeaders();

        $model = new ArtikelModel();
        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond($data);
        }

        return $this->failNotFound('Data tidak ditemukan.');
    }

    public function update($id = null)
    {
        $this->setCorsHeaders();

        $model = new ArtikelModel();
        $input = $this->getInputData();

        $judul = $input['judul'] ?? '';
        $isi = $input['isi'] ?? '';
        $status = $input['status'] ?? 'draft';

        if ($judul === '' || $isi === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 400,
                    'error' => true,
                    'messages' => 'Judul dan isi artikel wajib diisi.'
                ]);
        }

        $data = [
            'judul'  => $judul,
            'isi'    => $isi,
            'status' => $status,
            'slug'   => $this->makeSlug($judul)
        ];

        $model->update($id, $data);

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data berhasil diubah.'
                ]
            ]);
    }

    public function delete($id = null)
    {
        $this->setCorsHeaders();

        $model = new ArtikelModel();
        $data = $model->where('id', $id)->first();

        if ($data) {
            $model->delete($id);

            return $this->response
                ->setStatusCode(200)
                ->setJSON([
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data berhasil dihapus.'
                    ]
                ]);
        }

        return $this->failNotFound('Data tidak ditemukan.');
    }
}