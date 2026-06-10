<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDoctor extends Migration
{
    public function up()
    {
        $this->forge->addField([
    'id' => [
        'type' => 'INT',
        'constraint' => 11,
        'unsigned' => true,
        'auto_increment' => true
    ],
    'full_name' => [
        'type' => 'VARCHAR',
        'constraint' => 100
    ],
        'specialty' => [
        'type' => 'VARCHAR',
        'constraint' => 100
    ],
        'professional_license' => [
        'type' => 'VARCHAR',
        'constraint' => 8,
         'unique'     => true
    ],
        'created_at' => [
        'type' => 'DATETIME',
        'null' => true
    ],
            'updated_at' => [
        'type' => 'DATETIME',
        'null' => true
    ],
            'deleted_at' => [
        'type' => 'DATETIME',
        'null' => true
    ],
]);

$this->forge->addKey('id', true);
$this->forge->createTable('doctors');
    }

    public function down()
    {
        
        $this->forge->dropTable('doctors');
    }
}
