<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Produtos{
	
	// ============================================================
	public function lista_produtos_disponiveis($categoria){
		
		$bd = new Database();
		
		$sql = "SELECT * FROM produtos WHERE visivel = 1";
		
		if($categoria == 'homem' || $categoria == 'mulher'){
			$sql .= " AND categoria = '$categoria'";
		}
		
		// busca toda a informação dos produtos disponíveis na base de dados
		$produtos = $bd->select($sql);
		
		return $produtos;
	}
}

?>