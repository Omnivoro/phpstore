<?php

namespace core\controladores;

use core\classes\Functions;

class Main{

    // ===========================================================
    public function index(){

        
        $clientes = ['joao', 'ana', 'carlos'];
		
		$dados = [
			'titulo' => 'Este é o título'
		];

        Functions::Layout([
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