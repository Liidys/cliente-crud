<?php

use PHPUnit\Framework\TestCase;
use App\Services\ClienteService;

class ClienteTest extends TestCase
{
    private $clienteService;

    protected function setUp(): void
    {
        $this->clienteService = new ClienteService();
    }

    public function testCriarCliente()
    {
        $cliente = $this->clienteService->criarCliente('João', '2002-07-15', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'joao@example.com');
        $this->assertNotNull($cliente);
        $this->assertEquals('João', $cliente->nome);
    }

    public function testListarClientes()
    {
        $clientes = $this->clienteService->listarClientes();
        $this->assertIsArray($clientes);
        $this->assertNotEmpty($clientes);
    }

    public function testEditarCliente()
    {
        $cliente = $this->clienteService->criarCliente('Carlos', '1985-05-10', '987.654.321-00', 'Rua X, 123', '4002-4567', 'carlos@example.com');
        $clienteEditado = $this->clienteService->editarCliente($cliente->id, 'Carlos Silva', '1985-05-10', '987.654.321-00', 'Rua Y, 456', '4002-9876', 'carlos.silva@example.com');
        $this->assertEquals('Carlos Silva', $clienteEditado->nome);
    }

    public function testDeletarCliente()
    {
        $cliente = $this->clienteService->criarCliente('Ana', '1990-03-20', '123.987.456-00', 'Rua Z, 789', '4002-1234', 'ana@example.com');
        $this->assertTrue($this->clienteService->deletarCliente($cliente->id));
    }
}
