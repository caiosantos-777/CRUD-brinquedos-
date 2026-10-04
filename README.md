# Gestão de Brinquedos

Sistema web para gerenciar os brinquedos de uma loja, feito em PHP e MySQL. Ele faz as quatro operações de um CRUD: cadastrar, listar, editar e excluir brinquedos.

Cada brinquedo tem nome, categoria, faixa etária, preço e quantidade em estoque.

## Funcionalidades

- Cadastrar um novo brinquedo
- Listar todos os brinquedos cadastrados
- Editar os dados de um brinquedo
- Excluir um brinquedo

## Tecnologias

- PHP 
- MySQL
- HTML e CSS

## Segurança e validação

- Todas as operações com dados informados pelo usuário usam Prepared Statements
- Os campos são validados no servidor (campos vazios, preço e estoque numéricos e não negativos)
- Os textos exibidos na tela passam por `htmlspecialchars`
