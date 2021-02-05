<?php
use core\classes\Store;

$_SESSION['cliente'] = 'joao';
?>
<div>
	<?php if(Store::clienteLogado()): ?>
		<p>SIM</p>
	<?php else: ?>
		<p>NÃO</p>
	<?php endif;?>
</div>