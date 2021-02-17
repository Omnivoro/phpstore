<?php

namespace core\controllers;

use core\classes\Store;
use core\classes\EnviarEmail;
use core\classes\Database;
use core\models\Clientes;

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
		
		//verifica se a senha 1 é diferente a senha 2
		if($_POST['text_senha_1'] !== $_POST['text_senha_2']){
			$_SESSION['error'] = 'As senhas não são iguais';
			$this->novo_cliente();
			return;
		}
		
		//verifica se existe na base de dados cliente com o mesmo email
		$cliente = new Clientes();
		
		if($cliente -> verificar_email_existe($_POST['text_email'])){
			$_SESSION['error'] = 'Já exite um cliente com o mesmo email';
			$this->novo_cliente();
			return;
		}
		
		// inserir cliente na base de dados e devolver o purl
		$purl = $cliente -> registar_cliente();
			
		// envio do email para o cliente
        $email = new EnviarEmail();
		
		$email_cliente = strtolower(trim($_POST['text_email']));
									
		$resultado = $email -> enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
		
		if($resultado)
			echo 'Email enviado com sucesso!';
		else
			echo 'Aconteceu algum erro';

	}
	
	 // ===========================================================
    public function confirmar_email(){
		
		//verifica se já existe sessão aberta
		if(Store::clienteLogado()){
			$this->index();
			return;
		}
		
		// verifica se na _query string_ não existe um purl
		if(!isset($_GET['purl'])){
			$this->index();
			return;
		}
		
		$purl = $_GET['purl'];
		
		// verifica se o purl e válido
		if(strlen($purl) != 12){
			$this->index();
			return;
		}
		
		$cliente = new Clientes();
		
		$resultado = $cliente->validar_email($purl);

        if($resultado){
            echo 'Conta validada com sucesso.';
        } else {
            echo 'A conta não foi validada.';
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