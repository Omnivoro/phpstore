<?php

// coleção de rotas
$rotas = [
    'inicio' => 'main@index',
    'loja' => 'main@loja',
    'carrinho' => 'loja@carrinho'
];

// define ação por defeito
$acao = 'inicio';

// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    } else {
        $acao = $_GET['a'];
    }
}

// trata a definição da rota
$partes = explode('@',$rotas[$acao]);

var_dump($partes);
