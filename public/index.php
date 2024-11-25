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
    <title>Cliente CRUD</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/scripts.js" defer></script>
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
        <button type="submit" name="criar" class="btn-editar">Criar</button>
    </form>

    <h2>Listar Clientes</h2>
    <ul>
        <?php foreach ($clientes as $cliente): ?>
            <li>
                <?= htmlspecialchars($cliente->nome) ?> - <?= htmlspecialchars($cliente->data_nascimento) ?> - <?= htmlspecialchars($cliente->cpf) ?> - <?= htmlspecialchars($cliente->endereco) ?> - <?= htmlspecialchars($cliente->telefone) ?> - <?= htmlspecialchars($cliente->email) ?>
                <form method="POST" onsubmit="return confirmarExclusao();" style="display:inline;">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($cliente->id) ?>">
                    <button type="submit" name="deletar" class="btn-deletar">Deletar</button>
                </form>


                <a href="editar.php?id=<?= htmlspecialchars($cliente->id) ?>" class="btn-editar">Editar</a>

            </li>
        <?php endforeach; ?>
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
