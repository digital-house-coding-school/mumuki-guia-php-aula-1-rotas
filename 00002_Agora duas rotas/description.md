Como já sabemos, muitas vezes, quando preenchemos o formulário, o usuário usa a mesma URL duas vezes.

A primeiro, por **GET** para ver o formulário.

A segundo, por **POST** para enviar a informaçõa preenchida.

O Laravel nos permite dividir a lógica, pois nos permite escrever duas rotas diferentes que respondem a metódos diferentes.

Dado isso, pedimos a você:

> 1. Crie uma rota para "/cadastro" por **GET** que retorna o texto "Cadastro"

> 2. Crie uma rota para "/cadastro" pelo **POST** que retorna o texto "Bem vindo"

Você pode supor que está gravando sua solução diretamente no arquivo de rotas.