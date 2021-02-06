<?php

namespace core\controladores;

use core\classes\Store;

class Main{

    // ===========================================================
    public function index(){

        Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'inicio',
			'layouts/footer',
            'layouts/html_footer',
        ]);

    }

    // ===========================================================
    public function loja(){
        
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'loja',
			'layouts/footer',
            'layouts/html_footer',
        ]);
    }

}