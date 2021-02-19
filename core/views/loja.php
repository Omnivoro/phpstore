<?php $produto = $produtos[0]; ?>

<div class="container-fluid espaco-fundo">
	<div class="row">
		<div class="col-12">
			<h3>Loja</h3>	
		</div>
	</div>
	
	<!-- produtos -->
	<div class="row">
		<div class="col-sm-4">
			<div class="text-center p-3">
				<img src="assets/images/produtos/<?= $produto->imagem ?>" >
				<h3><?= $produto->nome_produto ?></h3>
				<h2><?= $produto->preco ?></h2>
				<p><small><?= $produto->descricao ?></small></p>
				<div>
					<button>Addicionar ao carrinho</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!--
stdClass Object
(
    [id_produto] => 1
    [categoria] => homem
    [nome_produto] => Tshirt Vermelha
    [descricao] => Ab laborum, commodi aspernatur, quas distinctio cum quae omnis autem ea, odit sint quisquam similique! Labore aliquam amet veniam ad fugiat optio.
    [imagem] => tshirt_vermelha.png
    [preco] => 45.70
    [stock] => 100
    [visivel] => 1
    [created_at] => 2021-02-06 19:45:18
    [updated_at] => 2021-02-06 19:45:25
    [deleted_at] => 
)-->