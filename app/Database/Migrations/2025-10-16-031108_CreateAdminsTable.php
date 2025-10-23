<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        $this->forge->addfield([
            'id'=>[
                'type'=>'INT',
                'unsigned'=>true,
                'auto_increment'=>true,
            ],
            'username'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
            ],
            'email'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
            ],
            'password'=>[
                'type'=>'VARCHAR',
                'constraint'=>'255',
            ],
            'created_at timestamp default current_timestamp'
        ]);
        $this->forge->addkey('id',true);
        $this->forge->createTable('admins');
    }

    public function down()
    {
        $this->forge->dropTable('admins');
    }
}
