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

<h3>Mais concreta possível</h3>

Os pontos de entrada para a api devem ser simples e refletir a lógica do sistema o máximo possível para o client que a está consumindo. Então quanto mais concreto e mais representar a realidade, melhor será.


![Exemplo](http://dasunhegoda.com/wp-content/uploads/2015/10/Diagram1.png)
