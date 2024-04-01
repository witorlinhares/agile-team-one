<?php
/**
 * Classe responsável por gerenciar informações relacionadas a cupons.
 */
class CupomManager {

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
     * Cria um novo cupom.
     *
     * @param int    $estabelecimento ID do estabelecimento.
     * @param string $nome           Nome do cupom.
     * @param string $descricao      Descrição do cupom.
     * @param string $codigo         Código do cupom.
     * @param string $tipo           Tipo do cupom.
     * @param float  $desconto_porcentagem Desconto em porcentagem.
     * @param float  $desconto_fixo  Desconto fixo.
     * @param float  $valor_maximo    Valor máximo do desconto.
     * @param int    $quantidade      Quantidade disponível do cupom.
     * @param string $validade        Data de validade do cupom.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function newCupom($estabelecimento, $nome, $descricao, $codigo, $tipo, $desconto_porcentagem, $desconto_fixo, $valor_maximo, $quantidade, $validade) {
        $query = "INSERT INTO cupons (rel_estabelecimentos_id, nome, descricao, codigo, tipo, desconto_porcentagem, desconto_fixo, valor_maximo, quantidade, validade) VALUES ('$estabelecimento', '$nome', '$descricao', '$codigo', '$tipo', '$desconto_porcentagem', '$desconto_fixo', '$valor_maximo', '$quantidade', '$validade')";
        return $this->executeQuery($query);
    }

     /**
     * Edita um cupom existente.
     *
     * @param int    $id               ID do cupom a ser editado.
     * @param string $nome             Novo nome do cupom.
     * @param string $descricao        Nova descrição do cupom.
     * @param string $codigo           Novo código do cupom.
     * @param string $tipo             Novo tipo do cupom.
     * @param float  $desconto_porcentagem Novo desconto em porcentagem.
     * @param float  $desconto_fixo    Novo desconto fixo.
     * @param float  $valor_maximo      Novo valor máximo do desconto.
     * @param int    $quantidade        Nova quantidade disponível do cupom.
     * @param string $validade          Nova data de validade do cupom.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function editCupom($id, $nome, $descricao, $codigo, $tipo, $desconto_porcentagem, $desconto_fixo, $valor_maximo, $quantidade, $validade) {
        $query = "UPDATE cupons SET nome = '$nome', descricao = '$descricao', codigo = '$codigo', tipo = '$tipo', desconto_porcentagem = '$desconto_porcentagem', desconto_fixo = '$desconto_fixo', valor_maximo = '$valor_maximo', quantidade = '$quantidade', validade = '$validade' WHERE id = '$id'";
        return $this->executeQuery($query);
    }

    /**
     * Exclui um cupom.
     *
     * @param int $id ID do cupom a ser excluído.
     *
     * @return bool Retorna true se a operação for bem-sucedida, false caso contrário.
     */
    public function deleteCupom($id) {
        $query = "DELETE FROM cupons WHERE id = '$id'";
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