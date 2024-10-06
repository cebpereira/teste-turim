<?php

require_once '../db_config.php';

class PessoaController
{
    private $conexao;

    public function __construct($host, $user, $password, $database)
    {
        $this->conectar($host, $user, $password, $database);
        $this->criarBD($database);
    }

    public function conectar($host, $user, $password, $database)
    {
        $this->conexao = mysqli_connect($host, $user, $password, $database);

        if (!$this->conexao) {
            die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
        }
    }

    public function criarBD($database)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS `$database`";
        if (mysqli_query($this->conexao, $sql)) {
            mysqli_select_db($this->conexao, $database);
            $this->criarTabelas();
        } else {
            die("Erro ao criar o banco de dados: " . mysqli_error($this->conexao));
        }
    }

    private function criarTabelas()
    {
        $sql = "CREATE TABLE IF NOT EXISTS pessoas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL
        )";

        if (!mysqli_query($this->conexao, $sql)) {
            die("Erro ao criar tabela pessoas: " . mysqli_error($this->conexao));
        }

        $sql = "CREATE TABLE IF NOT EXISTS filhos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(255) NOT NULL,
            pessoa_id INT,
            FOREIGN KEY (pessoa_id) REFERENCES pessoas(id) ON DELETE CASCADE
        )";

        if (!mysqli_query($this->conexao, $sql)) {
            die("Erro ao criar tabela filhos: " . mysqli_error($this->conexao));
        }
    }

    public function gravar($json)
    {
        $this->conexao->query("DELETE FROM filhos");
        $this->conexao->query("DELETE FROM pessoas");

        $data = json_decode($json, true);

        foreach ($data['pessoas'] as $pessoa) {
            $nome = mysqli_real_escape_string($this->conexao, $pessoa['nome']);
            $this->conexao->query("INSERT INTO pessoas (nome) VALUES ('$nome')");
            $pessoa_id = $this->conexao->insert_id;

            foreach ($pessoa['filhos'] as $filho) {
                $nomeFilho = mysqli_real_escape_string($this->conexao, $filho);
                $this->conexao->query("INSERT INTO filhos (pessoa_id, nome) VALUES ($pessoa_id, '$nomeFilho')");
            }
        }
    }

    public function ler()
    {
        $result = $this->conexao->query("SELECT * FROM pessoas");
        $pessoas = [];

        while ($row = $result->fetch_assoc()) {
            $filhos = [];
            $filhosResult = $this->conexao->query("SELECT nome FROM filhos WHERE pessoa_id = " . $row['id']);
            while ($filhoRow = $filhosResult->fetch_assoc()) {
                $filhos[] = $filhoRow['nome'];
            }
            $pessoas[] = [
                'nome' => $row['nome'],
                'filhos' => $filhos
            ];
        }

        return json_encode(['pessoas' => $pessoas]);
    }
}
