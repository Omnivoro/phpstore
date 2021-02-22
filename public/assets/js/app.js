/* app.js */

// ===========================================================
function adicionar_carrinho(id_produto){
	
	// adiciona a quantidade de produtos ao lado do icono do carrinho
	axios.defaults.withCredentials = true;
	axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
		.then(resp => document.getElementById('carrinho').innerText = resp.data)
		.catch(err => (console.log(err)));
}

// ===========================================================
function limpar_carrinho(){
	
	// limpa todo o carrino
	axios.defaults.withCredentials = true;
	axios.get('?a=limpar_carrinho')
		.then(() => document.getElementById('carrinho').innerText = 0)
		.catch(err => (console.log(err)));
}

