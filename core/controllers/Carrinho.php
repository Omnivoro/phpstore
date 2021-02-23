<?php

namespace core\controllers;

use core\classes\Store;
use core\classes\EnviarEmail;
use core\classes\Database;
use core\models\Clientes;
use core\models\Produtos;

class Carrinho{
	
	// ===========================================================
	public function adicionar_carrinho(){
		
		// busca a informação o id_produto query string
		$id_produto = $_GET['id_produto'];

		// adição/gestão da variável de sessão do carrinho 
		$carrinho = [];

		if(isset($_SESSION['carrinho']))
			$carrinho = $_SESSION['carrinho'];

		// adciona o produto ao carrinho
		if(key_exists($id_produto, $carrinho)){

			// já existe o produto, acresenta mais uma unidade
			$carrinho[$id_produto]++;
		}else{

			$carrinho[$id_produto] = 1;
		}

		$_SESSION['carrinho'] = $carrinho;

		// devolve a resposta (número de produtos do carrinho)
		$total_produtos = 0;
		foreach($carrinho as $produto_quantidade){
			$total_produtos += $produto_quantidade;
		}
		echo $total_produtos;
		
	}
	
	// ===========================================================
	public function limpar_carrinho(){
		
		// limpa todos os produtos do carrinho
		unset($_SESSION['carrinho']);
		
		// refrescar a página do carrinho
		$this->carrinho();
		
	}
	
	
	// ===========================================================
    public function carrinho(){
        
		//apresenta a pรกgina do carrinho
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'carrinho',
			'layouts/footer',
            'layouts/html_footer',
        ]);
    }
}
	
?>