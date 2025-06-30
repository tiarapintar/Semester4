<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailPhoneToPenulis extends Migration
{
    public function up()
    {
        $fields = [
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true, 
                'after'      => 'address',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true, 
                'after'      => 'email', 
            ],
        ];
        $this->forge->addColumn('penulis', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('penulis', ['email', 'phone']);
    }
}