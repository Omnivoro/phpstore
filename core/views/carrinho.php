<?php $total_quantidade = 0 ?>
<h3>Carrinho!</h3>
<a href="?a=limpar_carrinho" class="btn btn-sm btn-primary">Limpar carrinho</a>


<div class="container">
    <div class="row">
        <div class="col">

        <?php if($carrinho == null):?>
            <p>Carrinho vazio</p>
            <p><a href="?a=loja" class="btn btn-primary">Loja</a></p>
        <?php else: ?>
			<div style="margin-button: 80px;">
				<table class="table">
					<thead>
						<tr>
							<th>imgens</th>
							<th>Produto</th>
							<th class="text-center">Quantidade</th>
							<th class="text-end">Valor sub-total</th>
							<th>ações</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($carrinho as $produto):?>
							<!-- lista de produtos -->
							<tr>
								<td><img src="assets/images/produtos/<?= $produto['imagem']?>" class="img-fluid" width="50px"/></td>
								<td class="text-start align-middle"><h5><?= $produto['titulo'] ?></h5></td>
								<td class="text-center align-middle"><h5><?= $produto['quantidade'];?></h5></td>
								<td class="text-end align-middle"><h4>
									<?= number_format($produto['preco'], 2, ',', '.')?>
									&nbsp;&#36;</h4></td>
								<td class="text-start align-middle"><button class="btn btn-danger btn-sm">
									<i class="fas fa-times"></i>
								</button></td>
							</tr>
							<?php $total_quantidade += $produto['quantidade']; ?>
						<?php endforeach;?>
							<!-- total -->
							<tr>	
								<td></td>
								<td></td>
								<td class="text-center align-middle"><h5><?= $total_quantidade ?></h5></td>
								<td class="text-end align-middle"><h3>
									<?= number_format($total, 2, ',', '.') ?>
								&nbsp;&#36;</h3></td>
								<td class="text-start align-middle"><h3>Total</h3></td>
							</tr>
					</tbody>
				</table>
			</div>
        <?php endif; ?>
        </div>
    </div>
</div>