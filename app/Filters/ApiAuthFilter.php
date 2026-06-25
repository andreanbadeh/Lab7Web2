<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;
use Config\Services;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Abaikan preflight CORS
        if (strtolower($request->getMethod()) === 'options') {
            return;
        }

        // Ambil Authorization Header dari beberapa kemungkinan
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader) {
            $authHeader = $request->getServer('HTTP_AUTHORIZATION');
        }

        if (!$authHeader) {
            $authHeader = $request->getServer('REDIRECT_HTTP_AUTHORIZATION');
        }

        if (!$authHeader && function_exists('apache_request_headers')) {
            $headers = apache_request_headers();

            if (isset($headers['Authorization'])) {
                $authHeader = $headers['Authorization'];
            } elseif (isset($headers['authorization'])) {
                $authHeader = $headers['authorization'];
            }
        }

        if (!$authHeader) {
            return $this->unauthorized('Akses Ditolak. Token tidak ditemukan pada request!');
        }

        $token = null;

        if (preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
            $token = trim($matches[1]);
        }

        if (!$token) {
            return $this->unauthorized('Sesi Token tidak valid atau kedaluwarsa!');
        }

        $decodedToken = base64_decode($token, true);

        if (!$decodedToken || strpos($decodedToken, 'TOKEN-SECRET-') !== 0) {
            return $this->unauthorized('Token tidak sah.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }

    private function unauthorized($message)
    {
        $response = Services::response();

        return $response
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setStatusCode(401)
            ->setJSON([
                'status' => 401,
                'error' => true,
                'messages' => $message
            ]);
    }
}