<?php
session_start();
header("Content-type: application/json");
include_once '../conexao/database.php';
include_once '../class/geolocation.php';
include_once './pedido.php';

if (!empty($_POST)) {

    $data = $_POST;

    if (!empty($data['parcelas'])) {
        $parcelas = $data['parcelas'];
    } else {
        $parcelas = 0;
    }

    $pedido = Pedido::create($data['nome'], $data['cpf'], $data['valor'], $parcelas, $data['pagamento'], 0);

    if ($pedido->getForma_pagamento() == 3 || $pedido->getForma_pagamento() == 2) {

        $desconto = $pedido->DescontoDoPedito($pedido->getValor_total(), $pedido->getForma_pagamento());
        $pedido->setValor_total($desconto);
    } else {

        $parcelamento = $pedido->ParcelamentoPedito($pedido->getValor_total(), $pedido->getN_parcelas());
        $pedido->setValor_parcelado($parcelamento);
        $valor = $pedido->getValor_parcelado() * $pedido->getN_parcelas();
        $pedido->setValor_total($valor);
    }

    if ($pedido->insert($conn)) {
        $ultimoPedido = $pedido->UltimoPedido($conn);
        $_SESSION['pedido'] = $ultimoPedido;
        if (Geolocation::caputarLocalPrincipal($conn, $ultimoPedido)) {
            header("location: ../index.php");
        }
    }
}
?>
