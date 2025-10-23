<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data=array(
            'username'=>'oben',
            'email'=>'alixtiav@gmail.com',
            'password'=>password_hash('Oben2092', PASSWORD_BCRYPT),  
        );
        $this->db->table('admins')->insert($data);
    }
}
