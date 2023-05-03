<?php

namespace App\Models;

use CodeIgniter\Model;

class pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_usuario',
        'id_entregador',
        'local_de_entrega',
        'local_de_busca',
        'descricao',
        'peso',
        'status',
        'tamanho_pacote',
        'urgencia'
    ];

    public function getPedidoById($id)
    {
        return $this->find($id);
    }

    public function getAllPedidos()
    {
        return $this->findAll();
    }

    public function insertPedido($data)
    {
        return $this->insert($data);
    }

    public function updatePedido($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deletePedido($id)
    {
        return $this->delete($id);
    }
}
