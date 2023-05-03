<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration\Forge;
use CodeIgniter\Database\Migration\Migration;

class CreateTablePedidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_usuario' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_entregador' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'local_de_entrega' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'local_de_busca' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'descricao' => [
                'type' => 'TEXT',
            ],
            'peso' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'tamanho_pacote' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'urgencia' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id');
        $this->forge->addForeignKey('id_entregador', 'entregadores', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('pedidos');
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
    }
}
