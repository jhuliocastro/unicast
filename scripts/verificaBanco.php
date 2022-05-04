<?php
include __DIR__."/../vendor/autoload.php";

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

/*
 * FETCH DATA
 */
print("VERIFICANDO TABELA 'VENDAS'\n");
$vendas = $connect->query("SHOW COLUMNS FROM vendas");
//var_dump($users->fetchAll());
$vendas = $vendas->fetchAll();

print("-------------------------\n");

//COLUNA ID
$coluna = "id";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `id` INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`);");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//COLUNA DINHEIRO
$coluna = "dinheiro";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `dinheiro` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");