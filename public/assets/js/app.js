/* app.js */

function adicionar_carrinho(id_produto){
	
	axios.defaults.withCredentials = true;
	axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
		.then(resp => (console.log(resp.data)))
		.catch(err => (console.log(err)));
}