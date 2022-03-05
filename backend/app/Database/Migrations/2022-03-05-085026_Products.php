<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'        => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'qty'         => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'created_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at'  => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }
    public function down()
    {
    }
}
