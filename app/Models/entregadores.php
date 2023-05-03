<?php

namespace App\Models;

use CodeIgniter\Model;

class Entregador extends Model
{
    protected $table = 'entregadores';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'senha', 'cpf'];

    protected $validationRules = [
        'nome' => 'required|max_length[50]',
        'email' => 'required|valid_email|max_length[100]|is_unique[entregadores.email]',
        'senha' => 'required|max_length[100]',
        'cpf' => 'required|exact_length[11]|is_unique[entregadores.cpf]'
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo nome é obrigatório.',
            'max_length' => 'O campo nome deve ter no máximo 50 caracteres.'
        ],
        'email' => [
            'required' => 'O campo e-mail é obrigatório.',
            'valid_email' => 'O e-mail informado não é válido.',
            'max_length' => 'O campo e-mail deve ter no máximo 100 caracteres.',
            'is_unique' => 'O e-mail informado já está cadastrado.'
        ],
        'senha' => [
            'required' => 'O campo senha é obrigatório.',
            'max_length' => 'O campo senha deve ter no máximo 100 caracteres.'
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório.',
            'exact_length' => 'O CPF informado não é válido.',
            'is_unique' => 'O CPF informado já está cadastrado.'
        ]
    ];
}
