<?php

class Pedido {

    private $idPedido;
    private $nome;
    private $cpf;
    private $valor_total;
    private $n_parcelas;
    private $forma_pagamento;
    private $valor_parcelado;

    public static function create($nome, $cpf, $valor_total, $n_parcelas, $forma_pagamento, $valor_parcelado) {
        $instance = new self();
        $instance->nome = $nome;
        $instance->cpf = $cpf;
        $instance->valor_total = $valor_total;
        $instance->n_parcelas = $n_parcelas;
        $instance->forma_pagamento = $forma_pagamento;
        $instance->valor_parcelado = $valor_parcelado;
        return $instance;
    }

    function __construct() {
        $this->idPedido = "";
        $this->nome = "";
        $this->cpf = "";
        $this->valor_total = "";
        $this->n_parcelas = "";
        $this->forma_pagamento = "";
        $this->valor_parcelado = "";
    }

    public function insert($conn) {
        $sql = "INSERT INTO pedido(nome, cpf, valor_total, n_parcelas, forma_pagamento, valor_parcelado) VALUES (:nome, :cpf, :valor_total, :n_parcelas, :forma_pagamento, :valor_parcelado)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':cpf', $this->cpf);
        $stmt->bindParam(':valor_total', $this->valor_total);
        $stmt->bindParam(':n_parcelas', $this->n_parcelas);
        $stmt->bindParam(':forma_pagamento', $this->forma_pagamento);
        $stmt->bindParam(':valor_parcelado', $this->valor_parcelado);

        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }

    public static function UpdateValorTotal($conn, $idPedido, $valor) {
        $sql = "UPDATE pedido SET valor_total = '$valor' WHERE (`idPedido` = '$idPedido')";
        $result = $conn->query($sql);
        if ($result)
            return true;
        else
            return false;
    }

    public static function UltimoPedido($conn) {
        $sql = "SELECT idPedido FROM pedido ORDER BY idPedido DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result) {
            return $result->fetch(PDO::FETCH_ASSOC)['idPedido'];
        } else
            return false;
    }

    public static function DeletePedido($conn, $idPedido) {
        $sql = "DELETE FROM pedido WHERE (idPedido = '$idPedido')";
        $result = $conn->query($sql);
        if ($result)
            return true;
        else
            return false;
    }

    public static function ListarTodosPedidos($conn) {
        $sql = "SELECT * FROM pedido";
        $result = $conn->query($sql);
        if ($result)
            return $result->fetchAll(PDO::FETCH_ASSOC);
        else
            return false;
    }

    public static function ListarPedido($conn, $idPedido) {
        $sql = "SELECT * FROM pedido WHERE idPedido = '$idPedido'";
        $result = $conn->query($sql);
        if ($result)
            return $result->fetchAll(PDO::FETCH_ASSOC);
        else
            return false;
    }

    public static function JurosPedido($valor, $parcelas) {
        $valor += $valor * 0.03;
        return $valor;
    }

    public static function DescontoDoPedido($valor, $pagamento) {

        if ($pagamento == 3) {
            $valor -= $valor * 0.10;
            return $valor;
        } else {
            $valor -= $valor * 0.05;
            return $valor;
        }
    }

    function getIdPedido() {
        return $this->idPedido;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getValor_total() {
        return $this->valor_total;
    }

    function getN_parcelas() {
        return $this->n_parcelas;
    }

    function getForma_pagamento() {
        return $this->forma_pagamento;
    }

    function getValor_parcelado() {
        return $this->valor_parcelado;
    }

    function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setValor_total($valor_total) {
        $this->valor_total = $valor_total;
    }

    function setN_parcelas($n_parcelas) {
        $this->n_parcelas = $n_parcelas;
    }

    function setForma_pagamento($forma_pagamento) {
        $this->forma_pagamento = $forma_pagamento;
    }

    function setValor_parcelado($valor_parcelado) {
        $this->valor_parcelado = $valor_parcelado;
    }

}

?>
