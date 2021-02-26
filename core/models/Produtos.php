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
	
	// ============================================================
	public function verificar_stock_produto($id_produto){
		
		$bd = new Database();
		
		$parametros = [
			':id_produto' => $id_produto
		];
		
		$resultado = $bd->select(
			"SELECT * FROM produtos 
			WHERE id_produto = :id_produto
			AND visivel = 1
			AND stock > 0",
		$parametros);
		
		return count($resultado) != 0 ? true : false;

	}
	
	// ============================================================
	public function buscar_produtos_por_ids($ids){

        $bd = new Database();
        return $bd->select("
            SELECT * FROM produtos
            WHERE id_produto IN ($ids)
        ");
    }
	
}

?>