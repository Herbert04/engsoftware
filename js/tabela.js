var tabela = document.getElementById("minhaTabela");
var linhas = tabela.getElementsByTagName("tr");

for (var i = 0; i < linhas.length; i++) {
    var linha = linhas[i];
    linha.addEventListener("click", function () {
        //Adicionar ao atual
        selLinha(this, false); //Selecione apenas um
        //selLinha(this, true); //Selecione quantos quiser
    });
}


function selLinha(linha, multiplos) {
    if (!multiplos) {
        var linhas = linha.parentElement.getElementsByTagName("tr");
        for (var i = 0; i < linhas.length; i++) {
            var linha_ = linhas[i];
            linha_.classList.remove("selecionado");
        }
    }
    linha.classList.toggle("selecionado");
}


var btnVisualizar = document.getElementById("visualizarDados");

btnVisualizar.addEventListener("click", function () {
    var selecionados = tabela.getElementsByClassName("selecionado");
    //Verificar se eestá selecionado
    if (selecionados.length < 1) {
        alert("Selecione pelo menos uma linha");
        return false;
    }

    var pedido = "";

    for (var i = 0; i < selecionados.length; i++) {
        var selecionado = selecionados[i];
        selecionado = selecionado.getElementsByTagName("td");
        pedido += selecionado[0].innerHTML;
    }

    document.location.href = "index.php?id=" + pedido;



});


$(function () {
    $('#minhaTabela').searchable({
        striped: true,
        oddRow: {'background-color': '#f5f5f5'},
        evenRow: {'background-color': '#fff'},
        searchType: 'fuzzy'
    });

});

function habilitaParcelamento() {
    document.getElementById("parcelas").disabled = false;
}
function DesabilitarParcelamento() {
    document.getElementById("parcelas").disabled = true;
}
