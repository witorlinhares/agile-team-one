<?php

class Estabelecimento
{
    private $id;
    private $subdominio;
    private $nome;
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function buscarPorSubdominio($subdominio)
    {
        $sql = "SELECT * FROM estabelecimentos WHERE subdominio = :subdominio";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':subdominio', $subdominio);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
 ?>

 
