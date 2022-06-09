<?php
$this->data["empresa"] = EMPRESA;
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<style>
    body{
        font-family: consolas;
        font-size: 12px;
        
    }
    .linha{
        border: 1px dashed #000;
    }

    @media print {
    .corpo { 
        page-break-after: always; 
        width: 80mm;
    }
}
</style>

<div class="container-fluid corpo">
    <div class="titulo">
        <div class="row">
            <div class="col" style="text-align: center;">
                <span style="font-size: 15px;"><?= RAZAO_SOCIAL ?></span><br/>
                <span style="font-size: 12px;"><?= ENDERECO ?></span><br/>
                <span style="font-size: 12px;"><?= CNPJ ?></span>
            </div>
        </div>
    </div>
    <hr size="1" class="linha">
    <div id="cliente">
        <div class="row">
            <div class="col" style="text-align: center; font-size: 12px;">
                <?= $this->data["cliente"] ?>
                <?= $this->data["cpf"] ?>
            </div>
        </div>
    </div>
    <hr size="1" class="linha">
    <div id="produtos">
        <div class="row" style="text-align: center; font-size: 12px;">
            <div class="col">
                DETALHES DA VENDA
            </div>
        </div>
    </div>
    <hr size="1" class="linha">
    <div style="word-wrap: break-word;">
        <?= $this->data["produtos"] ?>
    </div>
    <hr size="1" class="linha">
    <div class="row">
        <div class="col-6">
            Total: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["subTotal"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            Desconto: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["desconto"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            Total Pago: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["valorPago"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            Troco: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["troco"] ?>
        </div>
    </div>
    <hr size="1" class="linha">
    <div class="row" style="text-align: center; font-size: 12px;">
            <div class="col">
                FORMA DE PAGAMENTO
            </div>
        </div>
    <div class="row">
        <div class="col-6">
            DINHEIRO: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["dinheiro"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            PIX: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["pix"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            CARTÃO DE CRÉDITO: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["credito"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            CARTÃO DE DÉBITO: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["debito"] ?>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            CREDIARIO: 
        </div>
        <div class="col-6" style="text-align: right; font-weight: bold;">
            R$ <?= $this->data["crediario"] ?>
        </div>
    </div>

    <hr size="1" class="linha">
    <div class="row">
        <div class="col-12" style="text-align: center; font-weight: bold;">
            ID VENDA: <?= $this->data["numeroVenda"] ?><br/>
            <?= $this->data["dataHora"] ?>
        </div>
    </div>

</div>       

<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>