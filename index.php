<?php
session_start();

include_once './conexao/database.php';
include_once './class/pedido.php';
include_once './class/parcelamento.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/form.css">
    </head>
    <body>
        <form action="class/gerenciador.php" method="POST"> 
            <fieldset>
                <fieldset class="grupo">
                    <div class="campo">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required style="width: 30em" value="">
                    </div>  
                    <div class="campo">
                        <label for="cpf">CPF: (xxx.xxx.xxx-xx)</label>
                        <input type="text" id="cpf" name="cpf" required style="width: 20em" value="" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}">                       
                    </div> 
                </fieldset>
                <fieldset class="grupo">
                    <div class="campo">
                        <label>Forma de Pagamento</label>
                        <label>
                            <input type="radio" required name="pagamento" onclick="DesabilitarParcelamento()" value="3"> À Vista
                            <input type="radio" required name="pagamento" onclick="DesabilitarParcelamento()" value="2"> Débito
                            <input type="radio" required name="pagamento" onclick="habilitaParcelamento()" value="1"> Cartão
                        </label> 

                    </div>

                    <div class="campo">
                        <label for="valor">Valor da Compra</label>
                        <input type="number" id="valor" required name="valor" style="width: 10em" value="" min="-1" step=".01">
                    </div>
                    <div class="campo">
                        <label for="parcelas">Nª De Parcelas</label>
                        <input type="number" id="parcelas" disabled="true"  name="parcelas" style="width: 10em" value="" min="1">
                    </div>

                </fieldset>
                <div class="campo">
                    <button type="submit" name="submit">Finalizar Pedido</button>
                </div>

            </fieldset>
        </form>


        <hr>
        <div >
            <div>
                <table class="table" id='minhaTabela'>
                    <thead>
                        <tr>
                            <th>Nº Pedido</th>
                            <th>Cliente</th>
                            <th>CPF</th>
                            <th>Valor Total</th>
                            <th>Forma de Pagamento</th>
                            <th>Valor Parcelado</th>
                        <tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($_SESSION['pedido'])) :

                            $pedido = Pedido::ListarPedido($conn, $_SESSION['pedido']);
                            $parcelado = Parcelamento::ListarParcelamento($conn, $_SESSION['pedido']);
                            foreach ($pedido as $produto):

                                if ($produto['forma_pagamento'] == 3) {
                                    $pagamento = "À Vista";
                                } else if ($produto['forma_pagamento'] == 2) {
                                    $pagamento = "Debito";
                                } else {
                                    $pagamento = "Cartão";
                                }
                                ?>
                                <tr>
                                    <td><?= $produto['idPedido'] ?></td>
                                    <td><?= $produto['nome'] ?></td>
                                    <td><?= $produto['cpf'] ?></td>
                                    <td>R$ <?= number_format($produto['valor_total'], 2, ",", ".") ?></td>
                                    <td><?= $pagamento ?></td>
                                    <td>
                                        <?php
                                        $i = 0;
                                        foreach ($parcelado as $parcela): $i++;
                                            ?>
                                            <?= $i . 'x R$' . number_format($parcela['parcelas'], 2, ",", ".") ?>   </br>                                     
                                        <?php endforeach; ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                </br>
                <button id="visualizarDados"> Remover Pedido </button>
                <hr>
            </div>
        </div>  

        <?php
        if (!empty($_GET)):
            $pedido = $_GET['id'];
            if (Pedido::DeletePedido($conn, $pedido)) {
                echo "<script>alert('Pedido Removido com sucesso!')</script>";
                echo "<script>location.href='index.php';</script>";
            } else {
                echo "<script>alert('O pedido não pode ser removido!')</script>";
            }
        endif;
        ?>

    </body>
    <script src="js/tabela.js"></script>
    <script src="js/remover.js"></script>

</html>

