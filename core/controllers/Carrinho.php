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
			echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
			return;
		}
		
		// busca a informação o id_produto query string
		$id_produto = $_GET['id_produto'];
		
		$produtos = new Produtos();
		$resultado = $produtos->verificar_stock_produto($id_produto);
		
		if(!$resultado){
			echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
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
		
		// verificar se existe carrinho
        if(!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0){
            $dados = [
                'carrinho' => null
            ];
        } else {
			$dados = [
				'carrinho' => 1
			];
			
			$ids = [];
            foreach($_SESSION['carrinho'] as $id_produto => $quantidade){
                array_push($ids, $id_produto);
            }
		
			$ids = implode(",", $ids);
			$produtos = new Produtos();
			$resultados = $produtos->buscar_produtos_por_ids($ids);
		
			/* 
            fazer um ciclo por cada produto no carrinho
                - identificar o id e usar os dados da bd para criar
                  uma coleção de dados para a página do carrinho

                imagem | titulo | quantidade | preço | xxx
            */
			
			$dados_tmp = [];
			foreach($_SESSION['carrinho'] as $id_produto => $quantidade_carrinho){

				// imagem do produto
				foreach($resultados as $produto){
					if($produto->id_produto == $id_produto){
						$id_produto = $produto->id_produto;
						$imagem = $produto->imagem;
						$titulo = $produto->nome_produto;
						$quantidade = $quantidade_carrinho;
						$preco = $produto->preco * $quantidade;

						// colocar o produto na coleção
						array_push($dados_tmp, [
							'id_produto' => $id_produto,
							'imagem' => $imagem,
							'titulo' => $titulo,
							'quantidade' => $quantidade,
							'preco' => $preco
						]);

						break;
					}
				}
			}
			
			// calcular o total
            $total_da_encomenda = 0;
            foreach($dados_tmp as $item){
                $total_da_encomenda += $item['preco'];
            }
            //array_push($dados_tmp, $total_da_encomenda);

            $dados = [
                'carrinho' => $dados_tmp,
				'total' => $total_da_encomenda
            ];
		}
				
		//apresenta a pรกgina do carrinho
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'carrinho',
			'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }
}
	
?>