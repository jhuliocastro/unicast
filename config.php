<?php
const URL = "http://erpcastro";
const EMPRESA = "MRE ARMAZÉM";

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3307",
    "dbname" => "erpcastro",
    "username" => "jhuliocastro",
    "passwd" => "25072018",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];