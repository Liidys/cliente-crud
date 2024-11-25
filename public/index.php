<?php

require_once '../vendor/autoload.php';

use App\Controllers\ClienteController;
use App\Services\ClienteService;

$clienteService = new ClienteService();
$clienteController = new ClienteController($clienteService);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['criar'])) {
        $clienteController->criarCliente($_POST['nome'], $_POST['data_nascimento'], $_POST['cpf'], $_POST['endereco'], $_POST['telefone'], $_POST['email']);
    } elseif (isset($_POST['editar'])) {
        $clienteController->editarCliente($_POST['id'], $_POST['nome'], $_POST['data_nascimento'], $_POST['cpf'], $_POST['endereco'], $_POST['telefone'], $_POST['email']);
    } elseif (isset($_POST['deletar'])) {
        $clienteController->deletarCliente($_POST['id']);
    }
}

$clientes = $clienteController->listarClientes();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cliente CRUD</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Cadastro de Clientes</h1>

    <h2>Criar Cliente</h2>
    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="date" name="data_nascimento" placeholder="Data de Nascimento" required>
        <input type="text" name="cpf" placeholder="CPF" required>
        <input type="text" name="endereco" placeholder="Endereço" required>
        <input type="text" name="telefone" placeholder="Telefone" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="criar">Criar</button>
    </form>

    <h2>Listar Clientes</h2>
    <ul>
        <?php foreach ($clientes as $cliente): ?>
            <li>
                <?= $cliente->nome ?> - <?= $cliente->data_nascimento ?> - <?= $cliente->cpf ?> - <?= $cliente->endereco ?> - <?= $cliente->telefone ?> - <?= $cliente->email ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $cliente->id ?>">
                    <button type="submit" name="deletar">Deletar</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $cliente->id ?>">
                    <input type="text" name="nome" value="<?= $cliente->nome ?>" required>
                    <input type="date" name="data_nascimento" value="<?= $cliente->data_nascimento ?>" required>
                    <input type="text" name="cpf" value="<?= $cliente->cpf ?>" required>
                    <input type="text" name="endereco" value="<?= $cliente->endereco ?>" required>
                    <input type="text" name="telefone" value="<?= $cliente->telefone ?>" required>
                    <input type="email" name="email" value="<?= $cliente->email ?>" required>
                    <button type="submit" name="editar">Editar</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
