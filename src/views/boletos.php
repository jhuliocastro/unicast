
<?php
$this->layout("_theme", $this->data);
$this->data["empresa"] = EMPRESA;
?>

<div class="pcoded-content container-fluid">
    <div class="card">
        <div class="card-header">
            Boletos
        </div>
        <div class="card-body p-2">
            <div class="card-block">
                <div class="container-fluid">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCadastro">Cadastrar Boleto</button>
                    <hr>
                    <table id="tabela" class="display compact" style="width: 100%;">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Situação</td>
                            <td>Nº NFe</td>
                            <td>Empresa</td>
                            <td>Fornecedor</td>
                            <td>Valor</td>
                            <td>Data Vencimento</td>
                            <td>Data Emissão</td>
                            <td>Valor Pago</td>
                            <td>Data Pagamento</td>
                            <td>Ações</td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formCadastroBoleto" method="post" action="/boletos/cadastrar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Boleto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label>Documento</label>
                            <input type="text" id="documentoCadastro" name="documentoCadastro" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Valor</label>
                            <input type="text" id="valorCadastro" name="valorCadastro" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Empresa</label>
                        <input type="text" list="empresas" id="empresaCadastro" name="empresaCadastro" class="form-control" required>
                        <datalist id="empresas">
                            <?= $this->data["empresas"] ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label>Fornecedor</label>
                        <input type="text" list="fornecedores" class="form-control" required id="fornecedorCadastro" name="fornecedorCadastro">
                        <datalist id="fornecedores">
                            <?= $this->data["fornecedores"] ?>
                        </datalist>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label>Data Vencimento</label>
                            <input type="date" id="dataVencimentoCadastro" name="dataVencimentoCadastro" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label>Data de Emissão</label>
                            <input type="date" id="dataEmissaoCadastro" name="dataEmissaoCadastro" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Número da NFe</label>
                        <input type="number" id="chaveNFECadastro" name="chaveNFECadastro" required class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Código Barras</label>
                        <input type="number" id="codigoBarrasCadastro" name="codigoBarrasCadastro" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalBaixa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formBaixaBoleto" method="post" action="/boletos/baixar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Baixar Boleto :: <span id="idSpanBoletoBaixa"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idBoletosBaixa" name="idBoletoBaixa">
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label>Data Recebimento</label>
                            <input type="date" id="dataRecebimentoBaixa" name="dataRecebimentoBaixa" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Valor</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">R$</span>
                            <input type="text" id="valorBaixa" name="valorBaixa" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Baixar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modalBarcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formBaixaBoleto" method="post" action="/boletos/baixar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Barcode Boleto :: <span id="idSpanBoletoBarcode"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <img id="imagemBarcode" class="img-fluid" src="../../temp/barcode.svg">
                    <span id="codigoBarcode"></span>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->start("scripts"); ?>
<script>
    var tabela;
    $(document).ready(function () {

        $("#valorBaixa").mask('#.##0,00', {reverse: true});
        $("#valorCadastro").mask('#.##0,00', {reverse: true});

        tabela = $('#tabela').DataTable({
            "paging": true,
            "order": [[6, "desc"]],
            'autoFill': true,
            'responsive': true,
            'ajax': '/boletos/tabela',
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });


    });

    function excluir(id){
        Swal.fire({
            title: 'Confirma exclusão do boleto ' + id + '?',
            text: "Essa ação não tem volta.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/boletos/excluir', {id: id}, function(response){
                    console.log(response);
                    tabela.ajax.reload();
                    if(response.status === true){
                        Swal.fire(
                            'Boleto Excluído!',
                            'success'
                        );
                    }else{
                        Swal.fire(
                            'Erro ao excluir boleto!',
                            response.erro,
                            'success'
                        );
                    }
                });

            }
        });
    }

    function baixa(id){
        $("#idSpanBoletoBaixa").html(id);
        document.getElementById("idBoletosBaixa").value = id;
        $("#modalBaixa").modal('show');
    }

    function barcode(id){
        $("#idSpanBoletoBarcode").html(id);
        $.post('/boletos/barcode', {id: id}, function(response){
            $('#codigoBarcode').html(response);
            $('#imagemBarcode').attr('src', '/temp/barcode.svg');
            $("#modalBarcode").modal('show');
        });
    }

    function estornar(id){
        Swal.fire({
            title: 'Confirma estorno do boleto ' + id + '?',
            text: "Essa ação não tem volta.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/boletos/estornar/" + id;
            }
        });
    }

</script>
<?= $this->end("scripts"); ?>
