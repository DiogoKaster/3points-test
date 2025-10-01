# Início do projeto

Como o docker-compose no projeto é um .env.yml, alterei o nome para
que eu pudesse utilizar o padrão e subir os serviços com
docker compose up -d. Confesso que é uma preferência individual,
pois acho o docker maravilhoso pra se trabalhar em projetos
de equipe, facilita muita coisa.

No restante, apenas copiei o .env.docker para meu .env, nada mais.

# Visão geral da solução

Primeiramente, fiz uma análise como realmente iria funcionar a dinâmica de
página de admin e usuário, a princípio fiquei com dúvida se um usuário não admin
poderia criar páginas de comunidade (subreddit) ou não, mas pelo que entendi
somente admins podem criar as comunidades no painel do filament de forma
dinâmica como requisitado.

Depois disso, a parte do subreddit em si é fácil de entender, visto que é uma
estrutura simples, onde um subreddit terá vários posts e um post terá vários
comentários.

## Estrutura de banco de dados

Aqui eu descrevo um pouco das relações que as tabelas terão, pois será a primeira
parte do projeto que irei criar.

User (admin)  
Communities (author_id, name, slug, description)  
Community Members (user_id, community_id)  
Posts (author_id, community_id, title, body, votes)  
Comments (author_id, post_id, parent_id, body, votes)  
Votes (user_id, votable_id, votable_type, value)

> [Downvote e Upvote x Votes]  
> Aqui foi uma decisão importante quando pensei na performance de cálculo de
> upvotes e downvotes dos posts do nosso sistema. Pensando em granularidade,
> seria mais fácil para verificar individualmente quantos upvotes e downvotes
> tem em um determinado post separando em 2 colunas na tabela os votos.
> No entanto, olhando para o Reddit mesmo, eles mantém somente uma soma dos votos
> em geral, isso facilita a query que o sistema faz já que só vai ser necessário
> realizar um incremento ou decremento no votes para ter registrado no post se ele está com
> contagem positiva ou negativa.

## Recursos do admin

Para já ser possível criar comunidades de forma dinâmica, o primeiro resource que fiz
e que também é o central do sistema, foi o de comunidades. Em um futuro, irei
criar os resources relacionados como de posts, comentários e votos também.

## Layout

Para o layout, inicialmente defini as cores temáticas definidas no Figma com seus
respectivos nomes, tentei manter o máximo de fidelidade quanto a nomes de variáveis.

Removi também a tag main do arquivo welcome.blade.php, que agora é home.blade.php,
pois a main com seu padding é algo comum de todo o layout.

### Sidebar

Uma alteração de layout que eu fiz foi trocar o lugar onde a sidebar ficar no layout. Como,
da minha visão se trata de um componente em comum de todo o sistema, independente se
o usuário está logado ou não, além da sidebar também limitar o espaço que o conteúdo e navbar
ocupam, então faz mais sentido ser o primeiro componente da aplicação e disponível em todo o layout.

### Componente UserCommunitiesSidebar

Aqui eu fiz uma decisão de transformar os links de comunidades como um componente livewire
por alguns motivos. Primeiro que facilita a busca dos dados, queries das comunidades e etc.
Segundo, que quero logo mais deixar esse componente reativo quando o usuário
entrar em uma nova comunidade por meio de um $refresh dentro do componente
com um listener do evento de entrada em comunidade. Dessa forma, o usuário irá ver a sidebar atualizar no momento em que entrar em uma comunidade nova.
Além de claro, deixar a estrutura do front mais componentizada.

## Login e Registro

Como mencionado no discord, vi que foi permitido utilizar o laravel breeze
para lidar com autenticação. Eu pensei por um momento em só construir um painel
do filament para lidar com isso, mas quis não perder muito tempo. Instalei
o Breeze e fiz algumas alterações na estilização, além de excluir arquivos
que não eram necessários para esse teste.

### Componente CommunityPage

As razões pelo qual escolhi criar um componente livewire dessa página são as
mesma do UserCommunitiesSidebar, em geral, todos os componentes livewire que eu
criar tem a mesma motivação por trás. Como essa página irá lidar com operação
de entrada de membros e criação de posts, acho válida a separação também.

### Componente PostCard

Além das razões já comentadas anteriormente, esse componente será reutilizado em duas páginas:
home e community page, pois ambas mostram postagens das comunidades que o usuário
faz parte ou explora.
