<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';

        $model = new UserModel();
        $users = $model->findAll();

        return view('user/index', compact('users', 'title'));
    }

    public function login()
    {
        helper(['form']);

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Jika belum submit form, tampilkan halaman login
        if (!$email) {
            return view('user/login');
        }

        $session = session();
        $model   = new UserModel();

        $login = $model->where('useremail', $email)->first();

        if ($login) {
            $pass = $login['userpassword'];

            if (password_verify($password, $pass)) {

                $login_data = [
                    'user_id'    => $login['id'],
                    'user_name'  => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in'  => true,
                ];

                $session->set($login_data);

                return redirect()->to('/admin/artikel');
            } else {
                $session->setFlashdata('flash_msg', 'Password salah.');
                return redirect()->to('/user/login');
            }

        } else {
            $session->setFlashdata('flash_msg', 'Email tidak terdaftar.');
            return redirect()->to('/user/login');
        }
    }

    // 🔥 LOGOUT
    public function logout()
    {
        // Hapus semua session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/user/login');
    }
}