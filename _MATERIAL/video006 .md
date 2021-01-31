# [006](https://youtu.be/KxSugX0nPFs):&nbsp;&nbsp;&nbsp;&nbsp;CRIAÇÃO DO SISTEMA DE ROTAS

[01:26](https://youtu.be/KxSugX0nPFs?t=86):&nbsp;&nbsp;&nbsp;&nbsp;O ficheiro __index.php__ recibirá todo o fluxo de nossa aplicação. Nele se gerirá até agora o seguinte:

1. abertura da sessao:&nbsp;&nbsp;`php session_start();`
2. carregamento de mecanismo de configuração:&nbsp;&nbsp;`require_once('../config.php');`
3. carregamento das classes do projeto do sistema vendor:&nbsp;&nbsp;`require_once('../vendor/autoload.php');`
4. carregamento sistema de rotas:&nbsp;&nbsp;`require_once('../core/rotas.php');`

[01:21](https://youtu.be/KxSugX0nPFs?t=121):&nbsp;&nbsp;&nbsp;&nbsp;O ficheiro __routas.php__ que contêm as rotas de nossa aplicação, se colaca na raiz da pasta __classes__. Eventualmente será o único ficheiro que estará forá das pastas presnetes em __classes__

[02:30](https://youtu.be/KxSugX0nPFs?t=150):&nbsp;&nbsp;&nbsp;&nbsp;O sistema de rotas lê o conteudo da _query string_ do site e determina quais são as ações do fluxo da aplicação. 

A _query string_ é uma  _substring_ da _url_ identifica como&nbsp;&nbsp;`?a=`&nbsp;&nbsp;A _substring_ que se encontra a dereita da _query string_ é o endereçõ web do ficheiro __index.php__. A _substring_ que se encontra a ezquerda da _query string_ é a ação que executara o sistema de rotas. Exemplo:

```html
https://localhost/phpstore/public/index.php?a='inicio'
```


[02:59](https://youtu.be/KxSugX0nPFs?t=179):&nbsp;&nbsp;&nbsp;&nbsp;Define-se uma coleção de rotas mediante um _array_ associativo. As chaves (_keys_) deste array associativo corresponden a ação da _query string_ e identifican as rotas na aplicação. Os valores deste array associativo corresponden têm duas partes separadas por um símbolo de arroba (@). A primeira parte identifica o controlador que será carregado. A segunda parte identifica o método do controlador que será executado pela aplicação. Exemplo:

```php
$rotas = [
    'inicio' => 'main@index',
    'loja' => 'main@loja',
    'carrinho' => 'loja@carrinho'
];
```
[04:30](https://youtu.be/KxSugX0nPFs?t=270):&nbsp;&nbsp;&nbsp;&nbsp;Define-se a varíavel&nbsp;&nbsp;`$acao = 'inico'` &nbsp;&nbsp;cujo valor é a ação por defeito a ser executado pela aplicação quando a _url_ não tivesse _query string_ &nbsp;&nbsp;`?a=`&nbsp;&nbsp;. 

[05:00](https://youtu.be/KxSugX0nPFs?t=300):&nbsp;&nbsp;&nbsp;&nbsp;Verificação da existencia da ação na _query string_:

```php
// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    } else {
        $acao = $_GET['a'];
    }
}
```
1. Primeiro, verifica-se que a _query string_ está definida na _url_&nbsp;&nbsp;`if(isset($_GET['a']))`&nbsp;&nbsp;
2. Segundo, verifica-se que o parâmetro da _query string_, isto é o valor depois do símbolo de igual e encerrado em plicas, é uma ação contida no array associativo das rotas &nbsp;&nbsp;`if(!key_exists($_GET['a'], $rotas))`&nbsp;&nbsp;

[06:46](https://youtu.be/KxSugX0nPFs?t=406):&nbsp;&nbsp;&nbsp;&nbsp;Tratamento da definição da rota:
Aplica-se a função&nbsp;&nbsp;`explode()`&nbsp;&nbsp;o array associativo&nbsp;&nbsp;`$rotas`&nbsp;&nbsp;usando como índice o valor da varíavel&nbsp;&nbsp;`$acao`&nbsp;&nbsp; e guarda-se o valor que está retorna na varíavle &nbsp;&nbsp;`$partes`&nbsp;&nbsp;
O primer parâmetro da função&nbsp;&nbsp;`explode()`&nbsp;&nbsp; é um delimitador, neste caso o símbolo de arroba (@). A função&nbsp;&nbsp;`explode()`&nbsp;&nbsp; faz um _split_ valor associado a chaves passada na varíavel&nbsp;&nbsp;`$acao`&nbsp;&nbsp;

[11:05](https://youtu.be/KxSugX0nPFs?t=665):&nbsp;&nbsp;&nbsp;&nbsp;Uma vez feita a explação do elemento do array associativo&nbsp;&nbsp;`$rotas`&nbsp;&nbsp;o _array_&nbsp;&nbsp;`$partes`&nbsp;&nbsp;tem dos elementos, dos quais o primeiro identifica a classe do controlador, e o segundo ao método da classe do controlador que se executará.

[13:43](https://youtu.be/KxSugX0nPFs?t=823):&nbsp;&nbsp;&nbsp;&nbsp;A função&nbsp;&nbsp;`ucfirst()`&nbsp;&nbsp;põe em maiúscula a primeira letra de um _string_.

[14:32](https://youtu.be/KxSugX0nPFs?t=872):&nbsp;&nbsp;&nbsp;&nbsp;Atribuição da localização da classe _Main_ à varíavel&nbsp;&nbsp;`$controlador`&nbsp;&nbsp;especificando o seu _namespace_.:

```php
$controlador = 'core\\controladores\\'.ucfirst($partes[0]);
```

[15:31](https://youtu.be/KxSugX0nPFs?t=926):&nbsp;&nbsp;&nbsp;&nbsp;Instanciação da classe _Main_ mediante a varíavel &nbsp;&nbsp;`$controlador`&nbsp;&nbsp;que é atribuida a varíavel&nbsp;&nbsp;`$crt`&nbsp;&nbsp;:

```php
$ctr = new $controlador();
```

[15:53](https://youtu.be/KxSugX0nPFs?t=953):&nbsp;&nbsp;&nbsp;&nbsp;Atribuição do método &nbsp;&nbsp;`index()`&nbsp;&nbsp;a varíavel&nbsp;&nbsp;`$metodo`&nbsp;&nbsp;:

```php
$metodo = $partes[1];
```
Execução do método &nbsp;&nbsp;`index()`&nbsp;&nbsp;:

```php
$ctr->$metodo();
```
