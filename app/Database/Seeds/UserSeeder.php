<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'     => 'admin',
                'useremail'    => 'admin@email.com',
                'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
            [
                'username'     => 'user',
                'useremail'    => 'user@email.com',
                'userpassword' => password_hash('user123', PASSWORD_DEFAULT),
            ],
        ];

        // Insert ke tabel user
        $this->db->table('user')->insertBatch($data);
    }
}