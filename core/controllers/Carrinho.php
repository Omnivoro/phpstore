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
		
		if(isset($_GET['id_produto'])){
			$id_produto = $_GET['id_produto'];
			$_SESSION['teste'] = $id_produto;
			$sucesso = 'Adicionado con susseso o produto ' . $id_produto . ' ao carrinho';
			echo $sucesso;
			header($sucesso, true, 200);}
		else{
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = '?a=adicionar_carrinho&$id_produto=';
			header("Location: http://$host$uri/$extra", true, 404);
			exit;
		}
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
	
?>