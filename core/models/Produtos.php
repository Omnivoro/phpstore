<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Produtos{
	
	// ============================================================
	public function lista_produtos_disponiveis($categoria){
		
		$bd = new Database();
		
		$sql = "SELECT * FROM produtos WHERE visivel = 1";
		
		// buscar lista de categorias
		$categorias = $this->lista_categorias();
		
		if(in_array($categoria, $categorias))
			$sql .= " AND categoria = '$categoria'";
		
		// busca toda a informação dos produtos disponíveis na base de dados
		$produtos = $bd->select($sql);
		
		return $produtos;
	}
	
	// ============================================================
	public function lista_categorias(){
		
		$bd = new Database();
		
		$resultados = $bd->select("SELECT DISTINCT(categoria) FROM produtos");
		$categorias = [];
		foreach($resultados as $resultado)
			array_push($categorias, $resultado->categoria);

		return $categorias;
	}
	
}

?>