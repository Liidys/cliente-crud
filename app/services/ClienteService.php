<?php

namespace App\Services;

use App\Models\Cliente;
use App\Database\Database;

class ClienteService
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function listarClientes()
    {
        $stmt = $this->db->query("SELECT * FROM clientes");
        $clientes = [];
        while ($row = $stmt->fetch()) {
            $clientes[] = new Cliente(
                $row['id'], 
                $row['nome'], 
                $row['data_nascimento'], 
                $row['cpf'], 
                $row['endereco'], 
                $row['telefone'], 
                $row['email']
            );
        }
        return $clientes;
    }

    public function criarCliente($nome, $data_nascimento, $cpf, $endereco, $telefone, $email)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO clientes (nome, data_nascimento, cpf, endereco, telefone, email) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$nome, $data_nascimento, $cpf, $endereco, $telefone, $email]);
        return new Cliente($this->db->lastInsertId(), $nome, $data_nascimento, $cpf, $endereco, $telefone, $email);
    }

    public function editarCliente($id, $nome, $data_nascimento, $cpf, $endereco, $telefone, $email)
    {
        $stmt = $this->db->prepare(
            "UPDATE clientes SET nome = ?, data_nascimento = ?, cpf = ?, endereco = ?, telefone = ?, email = ? WHERE id = ?"
        );
        $stmt->execute([$nome, $data_nascimento, $cpf, $endereco, $telefone, $email, $id]);
        return new Cliente($id, $nome, $data_nascimento, $cpf, $endereco, $telefone, $email);
    }

    public function deletarCliente($id)
    {
        $stmt = $this->db->prepare("DELETE FROM clientes WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    }

}
