<?php

use core\classes\Database;

// abrir a sessao
session_start();

// carregar o config
require_once('../config.php');

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

$bd = New Database();
/*$clientes = $bd->select("SELECT * FROM clientes");
echo '<pre>';
echo $clientes[2]->nome;
echo '</pre>';*/

$bd->select("INSERT teste");






