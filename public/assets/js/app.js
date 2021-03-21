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
	let e = document.getElementById("confirmar_limpar_carrinho")
	e.style.display = "inline";
}

// ===========================================================
function limpar_carrinho_off(){
	let e = document.getElementById("confirmar_limpar_carrinho")
	e.style.display = "none";
}

