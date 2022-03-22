<?php
$this->data["empresa"] = EMPRESA;
?>
<style>
    .text-center {
        text-align: center;
    }
    .ttu {
        text-transform: uppercase;
    }
    .printer-ticket {
        display: table !important;
        width: 100%;
        max-width: 400px;
        font-weight: light;
        line-height: 1.3em;
    }
    .printer-ticket,
    .printer-ticket * {
        font-family: Tahoma, Geneva, sans-serif;
        font-size: 10px;
    }
    .printer-ticket th:nth-child(2),
    .printer-ticket td:nth-child(2) {
        width: 50px;
    }
    .printer-ticket th:nth-child(3),
    .printer-ticket td:nth-child(3) {
        width: 90px;
        text-align: right;
    }
    .printer-ticket th {
        font-weight: inherit;
        padding: 10px 0;
        text-align: center;
        border-bottom: 1px dashed #BCBCBC;
    }
    .printer-ticket tbody tr:last-child td {
        padding-bottom: 10px;
    }
    .printer-ticket tfoot .sup td {
        padding: 10px 0;
        border-top: 1px dashed #BCBCBC;
    }
    .printer-ticket tfoot .sup.p--0 td {
        padding-bottom: 0;
    }
    .printer-ticket .title {
        font-size: 1.5em;
        padding: 15px 0;
    }
    .printer-ticket .top td {
        padding-top: 10px;
    }
    .printer-ticket .last td {
        padding-bottom: 10px;
    }

</style>
<table class="printer-ticket">
    <thead>
    <tr>
        <th class="title" colspan="3"><?= $this->data["empresa"] ?></th>
    </tr>
    <tr>
        <th colspan="3"><?= $this->data["dataHora"] ?></th>
    </tr>
    <tr>
        <th colspan="3">
            <?= $this->data["cliente"] ?> <br />
            <?= $this->data["cpf"] ?>
        </th>
    </tr>
    <tr>
        <th class="ttu" colspan="3">
            <b>Cupom não fiscal</b>
        </th>
    </tr>
    </thead>
    <tbody>
    <?= $this->data["produtos"] ?>
    </tbody>
    <tfoot>
    <tr class="sup ttu p--0">
        <td colspan="3">
            <b>Totais</b>
        </td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Sub-total</td>
        <td align="right">R$ <?= $this->data["subTotal"] ?></td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Desconto</td>
        <td align="right">R$ <?= $this->data["desconto"] ?></td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Total</td>
        <td align="right">R$ <?= $this->data["total"] ?></td>
    </tr>
    <tr class="sup ttu p--0">
        <td colspan="3">
            <b>Pagamentos</b>
        </td>
    </tr>
    <tr class="ttu">
        <td colspan="2"><?= $this->data["modoPagamento"] ?></td>
        <td align="right">R$ <?= $this->data["total"] ?></td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Total pago</td>
        <td align="right">R$ <?= $this->data["valorPago"] ?></td>
    </tr>
    <tr class="ttu">
        <td colspan="2">Troco</td>
        <td align="right">R$ <?= $this->data["troco"] ?></td>
    </tr>
    <tr class="sup">
        <td colspan="3" align="center">
            <b>Pedido: <?= $this->data["numeroVenda"] ?></b>
        </td>
    </tr>
    <tr class="sup">
        <td colspan="3" align="center">
            www.erpcastro.com.br
        </td>
    </tr>
    </tfoot>
</table>

<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>