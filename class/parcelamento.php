<?php

class Parcelamento {

    private $id;
    private $idPedido;
    private $parcelas;

    public static function create($idPedido, $parcelas) {
        $instancie = new self();
        $instancie->idPedido = $idPedido;
        $instancie->parcelas = $parcelas;
        return $instancie;
    }

    function __construct() {
        $this->id = "";
        $this->idPedido = "";
        $this->parcelas = "";
    }

    public function insert($conn) {

        $sql = "INSERT INTO parcelamento(idPedido, parcelas) VALUES (:idPedido, :parcelas)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idPedido', $this->idPedido);
        $stmt->bindParam(':parcelas', $this->parcelas);
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());
        } else {
            return true;
        }
    }

    public static function ParcelamentoPedido($conn, $valor, $parcelas, $idPedido) {
        $valor_parcelado = number_format(($valor / $parcelas), 2); //121,93/4 = 30,4825
        $diferenca = $valor - ($valor_parcelado * $parcelas);

        for ($index = 1; $index <= $parcelas; $index++) {
            if ($index == 1 && $parcelas != 1) {
                $valor_comDiferenca = $valor_parcelado + $diferenca;
                $parcelamento = Parcelamento::create($idPedido, $valor_comDiferenca);
                $parcelamento->insert($conn);
            } else {
                $parcelamento = Parcelamento::create($idPedido, $valor_parcelado);
                $parcelamento->insert($conn);
            }
        }
    }

    public static function ListarParcelamento($conn, $idPedido) {
        $sql = "SELECT parcelas FROM parcelamento WHERE idPedido = '$idPedido'";
        $result = $conn->query($sql);
        if ($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else
            return false;
    }

}
