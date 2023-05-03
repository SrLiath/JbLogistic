<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEntregadoresTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'senha' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cpf' => [
                'type'       => 'VARCHAR',
                'constraint' => '11',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('entregadores');
    }

    public function down()
    {
        $this->forge->dropTable('entregadores');
    }
}
