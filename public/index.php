<?php

use core\classes\Database;

// abrir a sessao
session_start();

// carregar o config
require_once('../config.php');

// carrega todas as classes do projeto
require_once('../vendor/autoload.php');

$a = new Database();