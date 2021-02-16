<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Clientes{
	
	// ============================================================
	public function  verificar_email_existe($email){
		
		$bd = new Database();

		$parametros = [
			':e' => strtolower(trim($email))
		];

		$resultados = $bd->select("
			SELECT email FROM clientes WHERE email = :e", 
		$parametros);


		if(count($resultados)!=0){
			return true;
		}
		else{
			return false;
		}
	}
	
	// ============================================================
	public function  registar_cliente(){
		
	$bd = new Database();	
	
    $purl = Store::criarHash();
		
	$parametros = [
        ':email' => strtolower(trim($_POST['text_email'])),
        ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
        ':nome_completo' => trim($_POST['text_nome_completo']),
        ':morada' => trim($_POST['text_morada']),
        ':cidade' => trim($_POST['text_cidade']),
        ':telefone' => trim($_POST['text_telefone']),
        ':purl' => $purl,
        ':ativo' => 0
   ];
		
    $bd->insert("
        INSERT INTO clientes VALUES(
               0,
            :email,
            :senha,
			:nome_completo,
            :morada,
            :cidade,
            :telefone,
        	:purl,
            :ativo,
            NOW(),
            NOW(),
			NULL
        )
    ", $parametros);
		
	return $purl;
		
	}
		
}

?>