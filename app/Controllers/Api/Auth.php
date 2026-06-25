<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Auth extends ResourceController
{
    protected $format = 'json';

    private function setCorsHeaders()
    {
        $this->response
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }

    public function options()
    {
        $this->setCorsHeaders();

        return $this->response
            ->setStatusCode(200)
            ->setBody('');
    }

    public function login()
    {
        $this->setCorsHeaders();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $model = new UserModel();

        $user = $model->where('username', $username)
                      ->orWhere('useremail', $username)
                      ->first();

        if ($user) {
            if (
                $password === $user['userpassword'] ||
                password_verify($password, $user['userpassword'])
            ) {
                return $this->respond([
                    'status' => 200,
                    'error' => null,
                    'messages' => 'Login Berhasil',
                    'data' => [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'token' => base64_encode(
                            "TOKEN-SECRET-" . $user['username']
                        )
                    ]
                ], 200);
            }
        }

        return $this->failUnauthorized(
            'Username atau Password yang Anda masukkan salah.'
        );
    }
}