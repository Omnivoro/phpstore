<?php

namespace core\controladores;

use core\classes\Functions;

class Main{

    // ===========================================================
    public function index(){

        
        $clientes = ['joao', 'ana', 'carlos'];

        Functions::Layout([
            'layouts/html_header',
            'pagina_inicial',
            'layouts/html_footer',
        ]);

    }

    // ===========================================================
    public function loja(){
        echo 'Loja!!!!!!';
    }

}