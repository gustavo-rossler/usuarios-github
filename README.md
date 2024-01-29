# Usuários Github

Este é um projeto simples para listar usuários do Github, e exibir seus detalhes.

## Executando

Para executar o projeto é necessário ter o docker e docker-compose instalado e rodando, depois de clonar o repositório, basta entrar na pasta e executar o comando:
```
docker-compose up -d
```

Depois do build, a página poderá ser acessada no endereço http://localhost:3009/

A API estará acessível no endereço http://localhost:3008/

## Código

Na pasta do projeto você encontrará a seguinte estrutura:

| Pasta     | Detalhes                                     |
| :-------- | :------------------------------------------- |
| `docker/` | Arquivos de configuração do Docker           |
| `src/`    | Código do projeto                            |
| `src/php` | API escrita em PHP                           |
| `src/vue` | Web app escrita em Vue                       |

### O projeto consiste em 2 imagens Docker.

 -  imagem com PHP versão 7.4 com servidor apache.
 -  imagem com nginx, essa imagem utiliza um dockerfile com multistage, onde a primeira fase faz o build do projeto vue, e a segunda copia os arquivos do build para a pasta do nginx e serve.
