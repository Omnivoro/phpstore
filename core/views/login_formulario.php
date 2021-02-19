<div class="container">
	<div class="row my-5">
		<div class="col-sm-4 offset-sm-4">
			<div class="text-center">
				<h3>LOGIN</h3>
			</div>	
			<form action="?a=login_submit" method="post">
			<!-- usuรกrio -->
				<div class="my-3">
					<label class="text-start">Usuรกrio:</label>
					<input type="email" name="text_usuario" class="form-control" placeholder="Usuรกrio" required>
				</div>
				<!-- senha -->
				<div class="my-3">
					<label>Senha</label>
					<input type="password" name="text_senha" class="form-control" placeholder="Senha" required>
				</div>
				<!-- submit -->
				<div class="my-4 text-center">
					<input type="submit" value="Entrar" class="btn btn-primary">
				</div>
			</form>
			<?php if(isset($_SESSION['erro'])):?>
				<div class="alert alert-danger text-center p-2">
					<?= $_SESSION['erro'] ?>
					<?php unset($_SESSION['erro']);?>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>