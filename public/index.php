<?php

use core\classes\Database;

// abrir a sessao
session_start();

// carregar o config
require_once('../config.php');

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

$bd = New Database();
$clientes = $bd->select("SELECT * FROM clientes");
echo '<pre>';
print_r($clientes);
echo '</pre>';

//Formato dos resultados que a base de dados envia:

//Resultado tipo array - fetchAll(PDO::FETCH_CLASSS);
//echo $clientes[0]->nome;

//Resultado tipo array - fetchAll(PDO::FETCH_ASSOC);
echo $clientes[0]['nome'];





