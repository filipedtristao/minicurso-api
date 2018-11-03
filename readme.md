<h1>Introdução</h1>

Esse repositório contém um projeto base de uma api desenvolvida com os conceitos da arquitetura REST e com autenticação JWT utilizando o Laravel 5.7. O projeto foi feito em conjunto com a equipe de desenvolvimento da [@eloverde-sistemas](https://github.com/eloverde-sistemas) no minicurso sobre APIs e arquitetura REST ministrado na empresa.

Para esclarecer/exemplificar melhor os conceitos, abaixo há uma tradução/adaptação de um texto do blog [dasunhegoda](http://dasunhegoda.com/rest-api-architecture-best-practices/1049/), que explica os principais pontos. 

<h2>Introdução?</h2>

A Arquitetura SOA (Service Oriented Architecture ou Arquitetura Orientada a Serviço) nos dias atuais é um padrão que tem muita adesão e cada vez mais aplicações são desenvolvidas sob esse conceito. Nesse pattern de desenvolvimento, um conjunto de serviços garante a integração entre negócio e tecnologia por meio de interfaces e comunicação acoplada. 

<h2>O que é um Service/API?</h2>
Trata-se de uma interface utilizada para promover a comunicação entre componentes ou softwares. Um webservice é um subtipo de serviço/api que sempre irá operar a partir do protocólo HTTP.

<h2>O que é REST?</h2>

A grosso modo significa Representational State Transfer. É uma forma simples de fazer a comunicação entre um cliente e um servidor, geralmente utilizando JSON.

<h2>Como deve funcionar um bom webservice?</h2>

E quais os principais requisitos para desenvolver uma boa api REST?

<h3>Menos abstrata e mais concreta possível</h3>

Os pontos de entrada para a api devem ser simples e refletir a lógica do sistema para o client que está consumindo. Então quanto mais concreto e mais representar a realidade, melhor será. Tipicamente a API pode representar o banco de dados da aplicação, onde caso você pussua uma tabela books (como no exemplo desse repositório) você terá um ponto de entrada na sua aplicação que se parecerá com: http://myapp/books


![Exemplo](http://dasunhegoda.com/wp-content/uploads/2015/10/Diagram1.png)

<h3>Possuir as operações CRUD</h3>

Assim como o banco de dados tem as opções SELECT, INSERT, UPDATE e DELETE para realizar as operações CRUD no banco, a API também terá para realizar as operações CRUD da aplicação. As operações CRUD na API devem se dar no mesmo ponto de entrada (http://myapp.com/books no exemplo anterior) e a operação a ser executada deve ser determinada pelo método HTTP. Abaixo uma tabela que compara como as operações que seriam realizadas em um banco de dados e como devem ser realizadas na api.

<table>
  <thead>
    <tr>
      <th>Operação no banco de dados</th>
      <th>URL a ser chamada na API</th>
      <th>Verbo HTTP a ser chamado na API</th>
      <th>Ação</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>SELECT * FROM books</td>
      <td>http://myapp.com/books</td>
      <td>GET</td>
      <td>Listar todos os livros</td>
    </tr>
    <tr>
      <td>INSERT INTO books</td>
      <td>http://myapp.com/books</td>
      <td>POST</td>
      <td>Inserir um novo livro</td>
    </tr>
    <tr>
      <td>UPDATE books</td>
      <td>http://myapp.com/books</td>
      <td>PUT ou PATCH</td>
      <td>Atualizar todos os livros</td>
    </tr>
    <tr>
      <td>DELETE FROM books</td>
      <td>http://myapp.com/books</td>
      <td>DELETE</td>
      <td>Excluir todos os livro</td>
    </tr>
    <tr>
      <td>SELECT * FROM books WHERE id=123</td>
      <td>http://myapp.com/books/123</td>
      <td>GET</td>
      <td>Listar o livro com o ID 123</td>
    </tr>
    <tr>
      <td>UPDATE books WHERE id=123</td>
      <td>http://myapp.com/books/123</td>
      <td>PUT ou PATCH</td>
      <td>Atualizar o livro com o ID 123</td>
    </tr>
    <tr>
      <td>DELETE FROM books WHERE id=123</td>
      <td>http://myapp/books</td>
      <td>DELETE</td>
      <td>Excluir o livro com o ID 123</td>
    </tr>
  </tbody>
</table>

<h3>Controle de Erros</h3>

O gerenciamento de erro é uma parte importante da API, pois é por meio deles que um cliente poderá garantir que uma operação foi executada ou não. Uma boa resposta de erro para a API se pareceria como abaixo:

```
{
   "status": 401,
   "error_code": 2005,
   "error_message": "Authentication token has expired",
   "more_info": "http://myapp.com/doc/token_error"
}
```

É importante que os erros respeitem os códigos HTTP. Por exemplo quando uma URL não for encontrada, a resposta HTTP é 404, quando há um erro na API, a resposta é 500 e assim por diante. Uma descrição de todos os códigos HTTP pode ser vista [aqui](https://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html)

<h3>Versionamento da API</h3>

A api pode ser versionada de diversas formas e você pode encontrar a opinião de muitos desenvolvedores na internet. O padrão atualmente utilizado na Eloverde se da seguinte forma. Para a api de versão 1, é colocado um V1 antes da url, ficando assim:

http://myapp.com/v1/books

É importante que esse versionamento é referente a <b>API e não ao seu código fonte!</b>. O versionamento dessa forma permite que o cliente que consome a sua API, possa trocar de versão sem quebrar a lógica de sua aplicação. Você geralmente irá trocar a versão da API quando alterar os parâmetros de input ou output de um de seus pontos de entrada. Por exemplo, vamos supor que o seu webservice de livros, o método POST de criação deveria receber apenas o parâmetro name, mas agora o parâmetro category_id também é obrigatório. Então para não quebrar as aplicações dos diversos clientes conectadas a sua api, você deveria manter duas versões, a V1 que aceita a entrada sem o campo category_id, e a V2 que não aceita a entrada se o category_id não estiver presente.

<3>Filtrando os dados</h3>

Assim como no banco de dados, o client deve ser capaz de efetuar filtros na api para trazer apenas os registros que lhe são pertinentes. Usando o nosso exemplo, se no ponto de entrada do nosso livro, desejássemos filtrar pela propriedade name, isso deveria ser feito com uma chamada da seguinte forma:

http://myapp.com/books?name=First%20Blood

E é claro que recursos como paginação também devem ser aplicados para evitar sobrecarga da api. Utilizando o Laravel, se quiséssemos acessar a página 2 dos nossos registros, a url deveria ficar assim:

http://myapp.com/books?page=2

<h3>Segurança</h3>

Sempre é bom cuidar da segurança de nossas aplicações, abaixo algumas recomendações do que usar para a api:

* Usar HTTPS para as requisições;
* Usar timestamps e fazer log de todas as requisições, dessa forma em caso de disputa judicial, você tem os registros armazenados para validação;
* Usar tokens de acesso para verificar se a api está sendo invocada por um client confiável. Nesse exemplo estamos utilizando autenticação via JWT.

<h3>Documentação</h3>

A documentação da api é a forma que nossos clients saberão como consumir a mesma. É muito fácil manter uma api quando os desenvolvedores do client tem acesso ao código fonte e podem ver como cada uma das coisas funciona. Porém a partir do momento que a equipe que desenvolve o client não tiver mais acesso aos fonts da api, a sua única maneira de debugar e descobrir como interagir com a mesma será a partir da documentação. Por isso é muito importante a existência de uma documentação consistente para nossos clients não terem problemas.

<h3>Concluindo sobre a API</h3>

Esses são os passos básicos para ter rodando uma boa e consistente API REST rodando no seu ambiente. Apesar de não ser um ambiente nada não muito complexo e que você não terá muitos problemas para configurar, tal estrutura trará muita flexibilidade e escalabilidade para as suas aplicações.

<h2>Autenticação JWT</h2>

Autenticação JWT (JSON Web Token) é uma forma de autenticação de padrão aberto que pode ser encontrado [aqui](https://tools.ietf.org/html/rfc7519). Na seção de autenticação de nossa aplicação, iremos gerar um token para nosso usuário. Uma vez que esse token é gerado, não precisamos mais consultar o nosso banco de dados para validar e nem obter informações sobre o usuário que está autenticado! Dessa forma, conseguimos deixar nossa api completamente stateless (ou seja, cada um dos pontos de entrada se torna independente e ao fazermos uma requisição ela vai ter um ciclo de vida com início meio e fim, sem manter dados).

Mas como é possível validar as informações do usuário sem consultar nenhuma base? Isso é possível porque o dentro do próprio token há as informações necessárias para validação e os dados de nosso usuário. Isso será melhor explicado a seguir.

<h3>Estrutura de um token JWT</h3>

![Estrutura do Token](https://static.imasters.com.br/wp-content/uploads/2017/05/04-1.png)
