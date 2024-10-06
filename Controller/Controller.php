<?php
require_once '../db_config.php';
require_once 'PessoaController.php';

class Controller
{
    private $controller;

    public function __construct()
    {
        $this->processRequest();
    }

    private function processRequest()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'ler';
        $this->controller = new PessoaController();

        switch ($action) {
            case 'gravar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $json = $_POST['json'] ?? '';
                    $this->controller->gravar($json);
                    echo json_encode(['message' => 'Dados gravados com sucesso!']);
                }
                break;

            case 'ler':
            default:
                echo $this->controller->ler();
                break;
        }
    }
}

new Controller();
