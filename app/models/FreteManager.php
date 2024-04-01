<?php

namespace App\Models;

/**
 * Classe responsável por gerenciar informações relacionadas a frete.
 */
class FreteManager {
    /**
     * Conexão com o banco de dados.
     *
     * @var resource
     */
    private $db_con;

    /**
     * Construtor da classe.
     *
     * @param resource $db_con Conexão com o banco de dados.
     */
    public function __construct($db_con) {
        $this->db_con = $db_con;
    }

    /**
     * Cria um novo frete.
     *
     * @param int    $estabelecimento ID do estabelecimento.
     * @param string $nome           Nome do frete.
     * @param float  $valor          Valor do frete.
     * @param string $outros         Outros detalhes do frete.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function newFrete($estabelecimento, $nome, $valor, $outros) {
        $query = "INSERT INTO frete (rel_estabelecimentos_id, nome, valor, outros) VALUES ('$estabelecimento', '$nome', '$valor', '$outros')";
        return $this->executeQuery($query);
    }

    /**
     * Edita um frete existente.
     *
     * @param int    $id    ID do frete a ser editado.
     * @param string $nome  Novo nome do frete.
     * @param float  $valor Novo valor do frete.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function editFrete($id, $nome, $valor) {
        $query = "UPDATE frete SET nome = '$nome', valor = '$valor' WHERE id = '$id'";
        return $this->executeQuery($query);
    }

    /**
     * Exclui um frete.
     *
     * @param int $id ID do frete a ser excluído.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function deleteFrete($id) {
        $query = "DELETE FROM frete WHERE id = '$id'";
        return $this->executeQuery($query);
    }

    /**
     * Executa uma consulta no banco de dados.
     *
     * @param string $query Consulta SQL.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    private function executeQuery($query) {
        return mysqli_query($this->db_con, $query);
    }
}