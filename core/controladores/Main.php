<?php

namespace core\controladores;

use core\classes\Store;

class Main{

    // ===========================================================
    public function index(){

        
        $dados = [
            'titulo' => 'Este é o título',
            'clientes' => ['joao', 'ana', 'carlos']
        ];

        Store::Layout([
            'layouts/html_header',
            'pagina_inicial',
            'layouts/html_footer',
        ],$dados);

    }

    // ===========================================================
    public function loja(){
        echo 'Loja!!!!!!';
    }

}