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
				
		// vai buscar o id_produto à query string
		if(!isset($_GET['id_produto'])){
			$location = "Location: " . BASE_URL . "index.php?a=loja";
			header($locaion, true, 404);
			return;
		}
		
		// busca a informação o id_produto query string
		$id_produto = $_GET['id_produto'];
		
		$produtos = new Produtos();
		$resultado = $produtos->verificar_stock_produto($id_produto);
		
		if(!$resultado){
			$erro = "Location: " . BASE_URL . "index.php?a=loja";
			header($erro, true, 404);
			return;
		}

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