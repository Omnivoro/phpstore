<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Produtos{
	
	// ============================================================
	public function lista_produtos_disponiveis(){
		
		$bd = new Database();
		
		// busca toda a informação dos produtos disponíveis na base de dados
		$produtos = $bd->select("SELECT * FROM produtos WHERE visivel = 1");
		
		return $produtos;
	}
}

?>