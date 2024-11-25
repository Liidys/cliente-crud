<?php

require_once '../vendor/autoload.php';

use App\Controllers\ClienteController;
use App\Services\ClienteService;

// Inicializar os serviços e controladores
$clienteService = new ClienteService();
$clienteController = new ClienteController($clienteService);

// Verificar se o ID foi passado via GET
if (!isset($_GET['id'])) {
    die("ID do cliente não fornecido.");
}

$id = $_GET['id'];

// Buscar o cliente pelo ID
$cliente = $clienteController->buscarClientePorId($id);
if (!$cliente) {
    die("Cliente não encontrado.");
}

// Atualizar o cliente quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clienteController->editarCliente(
        $id,
        $_POST['nome'],
        $_POST['data_nascimento'],
        $_POST['cpf'],
        $_POST['endereco'],
        $_POST['telefone'],
        $_POST['email']
    );

    // Redirecionar após a edição
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="POST">
        <input type="text" name="nome" value="<?= htmlspecialchars($cliente->nome) ?>" placeholder="Nome" required>
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($cliente->data_nascimento) ?>" placeholder="Data de Nascimento" required>
        <input type="text" name="cpf" value="<?= htmlspecialchars($cliente->cpf) ?>" placeholder="CPF" required>
        <input type="text" name="endereco" value="<?= htmlspecialchars($cliente->endereco) ?>" placeholder="Endereço" required>
        <input type="text" name="telefone" value="<?= htmlspecialchars($cliente->telefone) ?>" placeholder="Telefone" required>
        <input type="email" name="email" value="<?= htmlspecialchars($cliente->email) ?>" placeholder="Email" required>
        <button type="submit" class="btn-editar">Salvar Alterações</button>
    </form>
    <a href="index.php" class="btn-editar">Voltar</a>
</body>
</html>