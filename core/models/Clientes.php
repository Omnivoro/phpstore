<?php

namespace core\models;

use core\classes\Database;


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
}

?>