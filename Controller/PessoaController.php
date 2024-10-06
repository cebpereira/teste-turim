<?php
require_once '../db_config.php';
require_once '../Model/Pessoa.php';

class PessoaController
{
    private $conexao;

    public function __construct()
    {
        global $conexao;
        $this->conexao = $conexao;
    }

    public function gravar($json)
    {
        $data = json_decode($json, true);

        $this->conexao->query("DELETE FROM filhos");
        $this->conexao->query("DELETE FROM pessoas");

        $stmtPessoa = $this->conexao->prepare("INSERT INTO pessoas (nome) VALUES (?)");

        foreach ($data['pessoas'] as $pessoa) {
            $nome = $pessoa['nome'];
            $stmtPessoa->bind_param("s", $nome);
            $stmtPessoa->execute();

            if (isset($pessoa['filhos']) && is_array($pessoa['filhos'])) {
                $idPessoa = $this->conexao->insert_id;
                $stmtFilho = $this->conexao->prepare("INSERT INTO filhos (pessoa_id, nome) VALUES (?, ?)");

                foreach ($pessoa['filhos'] as $filho) {
                    $stmtFilho->bind_param("is", $idPessoa, $filho);
                    $stmtFilho->execute();
                }

                $stmtFilho->close();
            }
        }

        $stmtPessoa->close();
        return json_encode(["status" => "success", "message" => "Dados gravados com sucesso."]);
    }


    public function ler()
    {
        $pessoasArray = [];

        $sql = "SELECT p.id, p.nome AS pessoa_nome, f.nome AS filho_nome 
                FROM pessoas p 
                LEFT JOIN filhos f ON p.id = f.pessoa_id";
        $result = $this->conexao->query($sql);

        while ($row = $result->fetch_assoc()) {
            $pessoaId = $row['id'];
            if (!isset($pessoasArray[$pessoaId])) {
                $pessoasArray[$pessoaId] = [
                    'nome' => $row['pessoa_nome'],
                    'filhos' => []
                ];
            }
            if ($row['filho_nome']) {
                $pessoasArray[$pessoaId]['filhos'][] = $row['filho_nome'];
            }
        }

        return json_encode(['pessoas' => array_values($pessoasArray)], JSON_PRETTY_PRINT);
    }
}
