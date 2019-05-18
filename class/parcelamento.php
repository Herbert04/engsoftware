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
    
    public static function ParcelamentoPedito($valor, $parcelas, $idPedido) {
        $valor_com_juros = $valor + ($valor * 0.03); 
        $valor_parcelado = number_format(($valor_com_juros/$parcelas),2); //121,93/4 = 30,4825
        $diferenca = $valor_com_juros - ($valor_parcelado*$parcelas);
        
        for ($index = 0; $index < $parcelas; $index++) {
            
        }
        
    }

}
