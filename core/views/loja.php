<div class="container espaco-fundo">
	<div class="row">
		<div class="col-12 text-center my-4">
			<a href="?a=loja&c=todos" class="btn btn-primary">Todos</a>
			<?php foreach($categorias as $categoria): ?>
				<a href="?a=loja&c=<?= $categoria ?>" class="btn btn-primary"><?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?></a>
			<?php endforeach; ?>
		</div>
	</div>
	
	<!-- produtos -->
	<div class="row">
		<?php if(count($produtos) == 0): ?>
			<div class="text-center my-5">
				<h3>Não existem produtos disponíveis.</h3>
			</div>
		<?php else: ?>
			<?php foreach($produtos as $produto): ?>
				<div class="col-sm-4 col-6 p-2">
					<div class="text-center p-3 box-produto">
						<img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid" >
						<h3><?= $produto->nome_produto ?></h3>
						<h2><?= $produto->preco ?></h2>
						<div>
							<button class="btn btn-info btn-sm"><i class="fas fa-shopping-cart me-2">&nbsp;&nbsp;Addicionar ao carrinho</i></button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif;?>
	</div>
</div>
