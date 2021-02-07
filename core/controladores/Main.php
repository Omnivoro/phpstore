<?php

namespace core\controladores;

use core\classes\Store;

class Main{

    // ===========================================================
    public function index(){

		//apresenta a página de inicio
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
        
		//apresenta a página da loja
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'loja',
			'layouts/footer',
            'layouts/html_footer',
        ]);
    }
	
	// ===========================================================
    public function novo_cliente(){
		
		//verifica se já existe sessão aberta
		if(Store::clienteLogado()){
			$this->index();
			return;
		}
		
		//apresenta o layout para criar um novo utilizador
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'criar_cliente',
			'layouts/footer',
            'layouts/html_footer',
        ]);
    }
	
	// ===========================================================
    public function criar_cliente(){
		
		//verifica se já existe sessão aberta
		if(Store::clienteLogado()){
			$this->index();
			return;
		}
	
		//verifica se houve submissão de um formulário
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			$this->index();
			return;
		}
		
		echo 'OK';
	}
		
	
	// ===========================================================
    public function carrinho(){
        
		//apresenta a página do carrinho
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'carrinho',
			'layouts/footer',
            'layouts/html_footer',
        ]);
    }
	
}