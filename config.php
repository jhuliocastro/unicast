<?php
const URL = "http://localhost";
const EMPRESA = "MRE ARMAZÉM";

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "unicast",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

const RAZAO_SOCIAL = "MRE ARMAZEM DE CONSTRUCOES LTDA";
const CNPJ = "";
const ENDERECO = "RUA DOUTORA HERCILIA ARANHA DE MOURA, 19, BAIRRO NOVO, CARPINA - PE";