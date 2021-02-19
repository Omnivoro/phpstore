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
			$_SESSION['erro'] = 'As senhas não são iguais';
			$this->novo_cliente();
			return;
		}
		
		//verifica se existe na base de dados cliente com o mesmo email
		$cliente = new Clientes();
		
		if($cliente -> verificar_email_existe($_POST['text_email'])){
			$_SESSION['erro'] = 'Já exite um cliente com o mesmo email';
			$this->novo_cliente();
			return;
		}
		
		// inserir cliente na base de dados e devolver o purl
		$purl = $cliente -> registar_cliente();
			
		// envio do email para o cliente
        $email = new EnviarEmail();
		
		$email_cliente = strtolower(trim($_POST['text_email']));
									
		$resultado = $email -> enviar_email_confirmacao_novo_cliente($email_cliente, $purl);
		
		// apresenta o layout para informar o envio do email de confirmação
		if($resultado){
			Store::Layout([
				'layouts/html_header',
				'layouts/header',
				'criar_cliente_sucesso',
				'layouts/footer',
				'layouts/html_footer'
        ]);
			return;
		}else
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

		// apresenta o layou que a conta foi criada com sucesso
        if($resultado){
            Store::Layout([
				'layouts/html_header',
				'layouts/header',
				'conta_confirmada_sucesso',
				'layouts/footer',
				'layouts/html_footer'
        ]);
			return;
        } else {
			
            // redirecionar para a página inicial
			Store::redirect();
        }
	}
	
	// ===========================================================
    public function login(){
		
		// verifica se já existe um cliente logado
		if(Store::clienteLogado()){
			Store::redirect();
			return;
		}
		
		//apresenta a página da loja
		Store::Layout([
            'layouts/html_header',
			'layouts/header',
			'login_formulario',
			'layouts/footer',
            'layouts/html_footer'
        ]);
	}
	
	// ===========================================================
    public function login_submit(){
		
		// verifica se já existe um cliente logado
		if(Store::clienteLogado()){
			Store::redirect();
			return;
		}
		
		// verifica se foi efetuado o post do formulário de login
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			Store::redirect();
			return;
		}
		
		// verificar se o login é valido
		if(!isset($_POST['text_usuario']) ||
		   !isset($_POST['text_senha']) ||
		   !filter_var(trim($_POST['text_usuario']), FILTER_VALIDATE_EMAIL)){
			$_SESSION['erro'] = 'Login inválido';
			Store::redirect('login');
			return;
		}
		
		// prepara os dados para o model
        $usuario = trim(strtolower($_POST['text_usuario']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é válido
        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $senha);

        // analisa o resultado
        if(is_bool($resultado)){
         
            // login inválido
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;

        } else {

            // login válido. Coloca os dados na sessão
            $_SESSION['cliente'] = $resultado->id_cliente;
			$_SESSION['usuario'] = $resultado->email;
			$_SESSION['nome_cliente'] = $resultado->nome_completo;
            
			// redireciona para o início de nossa loja
			Store::redirect();
			
			
        }
		
	}
	
	// ===========================================================
    public function logout(){
		
		// remove as variáves da sessãremove
		unset($_SESSION['cliente']);
		unset($_SESSION['usuario']);
		unset($_SESSION['nome_cliente']);
		
		// redireciona para o início de nossa loja
			Store::redirect();
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