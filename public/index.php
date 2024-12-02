<?php

require_once '../vendor/autoload.php';

use App\Controllers\ClienteController;
use App\Services\ClienteService;

$clienteService = new ClienteService();
$clienteController = new ClienteController($clienteService);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['criar'])) {
        $clienteController->criarCliente(
            $_POST['nome'],
            $_POST['data_nascimento'],
            $_POST['cpf'],
            $_POST['endereco'],
            $_POST['telefone'],
            $_POST['email']
        );
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
    <title>Cadastro de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRAB+4/6FwGktl1T7vbd3KumftKDXcTcs3tUt0Ck12vLEL8j0wPwQAX1C" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/scripts.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">


</head>
<body>
    <div class="container">
        
        <h1 class="mt-4">Cadastro de Clientes</h1>
        <h2 class="subtitulo">Criar Cliente</h2>
        <div class="n">
        <form method="POST">
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Nome" required>
            </div>
            <div class="mb-3">
                <input type="date" name="data_nascimento" class="form-control" placeholder="Data de Nascimento" required>
            </div>
            <div class="mb-3">
                <input type="text" name="cpf" class="form-control" placeholder="CPF" required>
            </div>
            <div class="mb-3">
                <input type="text" name="endereco" class="form-control" placeholder="Endereço" required>
            </div>
            <div class="mb-3">
                <input type="text" name="telefone" class="form-control" placeholder="Telefone" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <button type="submit" name="criar" class="btn btn-primary">Criar</button>
        </form>
        </div>
        <h2 class="mt-4">Listar Clientes</h2>
        <ul class="list-group">
            <?php foreach ($clientes as $cliente): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= htmlspecialchars($cliente->nome) ?> - <?= htmlspecialchars($cliente->data_nascimento) ?> - <?= htmlspecialchars($cliente->cpf) ?> - <?= htmlspecialchars($cliente->endereco) ?> - <?= htmlspecialchars($cliente->telefone) ?> - <?= htmlspecialchars($cliente->email) ?>
                    <form method="POST" onsubmit="return confirmarExclusao();" style="display:inline;">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($cliente->id) ?>">
                        <button type="submit" name="deletar" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Deletar</button>
                    </form>
                    <a href="editar.php?id=<?= htmlspecialchars($cliente->id) ?>" class="btn-editar"><i class="fas fa-edit"></i> Editar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

