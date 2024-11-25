<?php

namespace App\Models;

class Cliente
{
    public $id;
    public $nome;
    public $data_nascimento;
    public $cpf;
    public $endereco;
    public $telefone;
    public $email;

    public function __construct($id, $nome, $data_nascimento, $cpf, $endereco, $telefone, $email)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->data_nascimento = $data_nascimento;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
    }
}
