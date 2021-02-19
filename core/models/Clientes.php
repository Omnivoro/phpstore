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
	
	// ============================================================
	public function  validar_email($purl){
			
		// validar o email do novo cliente
        $bd = new Database();
		
        $parametros = [
            ':purl' => $purl
        ];
		
        $resultados = $bd->select("
            SELECT * FROM clientes 
            WHERE purl = :purl
        ", $parametros);
			
		if(count($resultados) != 1){
			return false;
		}
		
		//foi encontrado este cliente com o purl indicado
		$id_cliente = $resultados[0]->id_cliente;
		
		// atualizar os dados do cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
		
        $bd->update("
            UPDATE clientes SET
            purl = NULL,
            activo = 1,
            updated_at = NOW()
			WHERE id_cliente = :id_cliente
        ", $parametros);
		
		return true;
	}
	
	// ============================================================
	public function  validar_login($usuario, $senha){
		
		
		// verificar se o login é válido
        $parametros = [
            ':usuario' => $usuario
        ];

        $bd = new Database();
        /*$resultados = $bd->select("
            SELECT * FROM clientes 
            WHERE email = :usuario 
            AND activo = 1 
            AND deleted_at IS NULL
        ", $parametros);*/
		
		$resultados = $bd->select("
		SELECT * FROM clientes 
		WHERE email = :usuario
		AND activo = 1
		AND deleted_at IS NULL", $parametros);
		
		//$count = count($resultados);
		//die($count);
		
		if(count($resultados) != 1){
			// não existe usuário
			return false;
		}else{
	
			// verifica a password
			$usuario = $resultados[0];
			if(!password_verify($senha, $usuario->senha)){
                
                // password inválida
                return false;
				
			}else{
				
				// login válido
				return $usuario;
			}
				
		}
	}
	
}

?>