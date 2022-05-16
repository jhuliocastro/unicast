<?php
include __DIR__."/vendor/autoload.php";

use CoffeeCode\DataLayer\Connect;

/*
 * GET PDO instance AND errors
 */
$connect = Connect::getInstance();
$error = Connect::getError();

/*
 * CHECK connection/errors
 */
if ($error) {
    echo $error->getMessage();
    exit;
}

$query = $connect->query("SELECT * FROM vendas_produtos");
echo "<pre>";
foreach($query as $q){
    $data = date("Y-m-d", strtotime($q->created_at));
    if($data == date('2022-05-11')){
        $query2 = $connect->query("SELECT * FROM produtos WHERE id='$q->produto'")->fetch();
        $quantidadeNova = $query2->estoqueAtual - $q->quantidade;

        $query3 = $connect->query("UPDATE produtos SET estoqueAtual='$quantidadeNova' WHERE id='$q->produto'");
        echo "Produto: $q->produto<br/>Quantidade Antiga: $query2->estoqueAtual<br/>Quantidade Nova: $quantidadeNova<br/>------------------------<br/>";
    }
}