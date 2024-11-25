<?php

namespace App\Controllers;

use App\Services\ClienteService;

class ClienteController
{
    private $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function listarClientes()
    {
        return $this->clienteService->listarClientes();
    }

    public function criarCliente($nome, $data_nascimento, $cpf, $endereco, $telefone, $email)
    {
        return $this->clienteService->criarCliente($nome, $data_nascimento, $cpf, $endereco, $telefone, $email);
    }

    public function editarCliente($id, $nome, $data_nascimento, $cpf, $endereco, $telefone, $email)
    {
        return $this->clienteService->editarCliente($id, $nome, $data_nascimento, $cpf, $endereco, $telefone, $email);
    }

    public function deletarCliente($id)
    {
        return $this->clienteService->deletarCliente($id);
    }

}
