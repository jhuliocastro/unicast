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
 //------------------------------------------------------------------------------------------------------------------------------

$tabela = "vendas_produtos";

print("VERIFICANDO TABELA '$tabela'\n");

$vendas = $connect->query("SHOW TABLES LIKE '$tabela'")->rowCount() > 0;

if($vendas <= 0){
    print("CRIANDO TABELA '$tabela'\n");
    $connect->query("CREATE TABLE $tabela (`id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`))");
}

print("TABELA '$tabela' OK");

$vendas = $connect->query("SHOW COLUMNS FROM $tabela");
//var_dump($users->fetchAll());
$vendas = $vendas->fetchAll();

print("-------------------------\n");

//INICIO COLUNA -------------------------------------------------------------------------------------------
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
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`$coluna`);");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------
//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "id_venda";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` INT NOT NULL;");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------
//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "produto";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` INT NOT NULL;");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------
//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "quantidade";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` INT NOT NULL;");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------
//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "created_at";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` TIMESTAMP NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "updated_at";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `$tabela` ADD `$coluna` TIMESTAMP NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

 //------------------------------------------------------------------------------------------------------------------------------
$tabela = "vendas";

print("VERIFICANDO TABELA '$tabela'\n");

$vendas = $connect->query("SHOW TABLES LIKE '$tabela'")->rowCount() > 0;

if($vendas <= 0){
    print("CRIANDO TABELA '$tabela'\n");
    $connect->query("CREATE TABLE $tabela (`id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`))");
}

print("TABELA '$tabela' OK");

$vendas = $connect->query("SHOW COLUMNS FROM vendas");
//var_dump($users->fetchAll());
$vendas = $vendas->fetchAll();

print("-------------------------\n");

//INICIO COLUNA -------------------------------------------------------------------------------------------
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
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` INT NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`$coluna`);");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "cliente";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` int NOT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");
//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "orcamento";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` int NOT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "valorTotal";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "desconto";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "troco";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
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
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ---------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "debito";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "credito";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "crediario";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "pix";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` FLOAT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "created_at";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` TIMESTAMP NOT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------

//INICIO COLUNA -------------------------------------------------------------------------------------------
$coluna = "updated_at";

print("PROCURANDO COLUNA '$coluna'\n");
$retorno = false;
foreach($vendas as $venda){
    if($venda->Field == $coluna){
        $retorno = true;
    }
}
if($retorno == false){
    print("CRIANDO COLUNA '$coluna'\n");
    $id = $connect->query("ALTER TABLE `vendas` ADD `$coluna` TIMESTAMP NOT NULL");
}

print("COLUNA '$coluna' OK\n");

print("-------------------------\n");

//FIM COLUNA ----------------------------------------------------------------------------------------------