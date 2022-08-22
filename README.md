# Knewin - Teste para Desenvolvedor PHP/Laravel

![](https://img.shields.io/github/languages/count/johny83br/knewin?color=%2304D361)[![](https://img.shields.io/github/last-commit/johny83br/knewin)](https://github.com/johny83br/knewin/commits/main) ![](https://img.shields.io/github/repo-size/johny83br/knewin) ![](https://img.shields.io/badge/license-MIT-brightgreen) 

## Sobre o projeto

Projeto elaborado para a participação do processo seletivo da Knewin, que visa trabalhar em quatro etapas:

- **Primeira etapa: backend**

  Essa é a etapa em que é desenvolvido os endpoints necessários para o CRUD de notícias e de usuários através do Laravel, utilizando o banco de dados PostgreSQL e Elasticsearch, com base no arquivo de importação chamado news.csv.

- **Segunda etapa: frontend**

  Essa é a etapa em que é construída duas telas, sem necessariamente estarem diretamente ligadas, pois terá um formulário de login que será construído através do Vue.js, e uma segunda tela que será construída através do Blade que fará buscas por índices criados no Elasticsearch.

- **Terceira etapa: implantação**

  Nesta etapa o projeto será implantado utilizando o Docker, e organizado através de containers.

- **Quarta etapa: versionamento**

  A última etapa será a entrega do código através de um repositório público no Github.

Para mais detalhes sobre o projeto veja [no arquivo em PDF](desafio.pdf).

## Organização das pastas no repositório

As pastas que estão disponibilizadas no repositório são:

- **/import:**

  Nesta pasta estarão disponibilizados os arquivos que foram utilizados para realizar a importação das notícias utilizando o endpoint criado no Laravel.

- **/app:**

  Nesta pasta estarão disponibilizados todos os arquivos que foram utilizados na elaboração dos endpoints, e da área restrita utilizando o Laravel, como também utilizando o Vue.js.

- **/docker-compose:**

  Nesta pasta estarão disponibilizados todos os arquivos que foram necessários para a criação dos containers do Docker, utilizando o docker-compose.yml.

## Documentação da API

Veja a documentação da API no Postman:

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/5965827f46575bb189f8?action=collection%2Fimport)

## Tecnologias utilizadas

Para este projeto foram utilizadas as seguintes tecnologias:

- PHP 7.4-fpm
- Laravel 8
- Vue.js 2.7.9
- Elasticsearch 8.2.2
- Kibana 8.2.2
- PostgreSQL 14.5
- NGINX 1.23.1
