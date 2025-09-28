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
Communities (user_id, name, slug, description, cover_img_path)  
Community User (user_id, community_id)  
Posts (user_id, community_id, title, body, score)  
Comments (user_id, post_id, parent_id, body, score)  
Votes (user_id, votable_id, votable_type, value)

> [Downvote e Upvote x Score]  
> Aqui foi uma decisão importante quando pensei na performance de cálculo de
> upvotes e downvotes dos posts do nosso sistema. Pensando em granularidade,
> seria mais fácil para verificar individualmente quantos upvotes e downvotes
> tem em um determinado post separando em 2 colunas na tabela os votos.
> No entanto, olhando para o Reddit mesmo, eles mantém somente uma soma dos votos
> em geral, isso facilita a query que o sistema faz já que só vai ser necessário
> realizar um incremento ou decremento no score para ter registrado no post se ele está com
> contagem positiva ou negativa.
