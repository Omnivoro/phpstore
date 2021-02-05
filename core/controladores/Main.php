<?php

namespace core\controladores;

use core\classes\Store;

class Main{

    // ===========================================================
    public function index(){

        
        $dados = [
            'titulo' => APP_NAME . ' ' . APP_VERSION,
            'clientes' => ['joao', 'ana', 'carlos']
        ];

        Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'inicio',
            'layouts/html_footer',
        ],$dados);

    }

    // ===========================================================
    public function loja(){
        echo 'Loja!!!!!!';
    }

}