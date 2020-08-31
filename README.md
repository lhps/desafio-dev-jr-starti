![image description here](https://www.starti.com.br/wp-content/uploads/2018/03/Starti_logo-120.png)

---

# DESAFIO DEV JR - STARTI SOLUÇÕES EM TECNOLOGIA

O desafio é criar uma API REST que cadastre/edite/exclua (CRUD) usuários e que seja possível autenticar no front-end com esses usuários.

## Solução

**Tecnologia Solicitada**

- PHP (Framework Laravel/Slim/Lumen)
- Javascript ES6 - VueJS
- MySQL

**Front-end**
Construir todas as validações necessárias para o CRUD.

**Diferenciais**
Semantic.UI

### Documentação

Clone esse repositório e crie seu projeto.
Ao término do desenvolvimento, adicione o usuário `jpizzribeiro` como colaborador do projeto. **Não adicione antes de finalizar o desenvolvimento**.

Faça a documentação para que possamos rodar o projeto e testá-lo.

## Dúvidas

Qualquer dúvida que você tenha, abra uma nova [_issue_](https://github.com/StartiOne/desafio-dev-jr/issues) nesse repo.

Boa sorte e até mais! ;)

# Para rodar o back-end

- Renomear o arquivo '.env.example' para '.env' e alterar as seguintes linhas:

  DB_CONNECTION=mysql
  DB_HOST=localhost
  DB_PORT=3306
  DB_DATABASE=starti
  DB_USERNAME=root
  DB_PASSWORD=

```zsh
# Entrar na pasta da api
$ cd crud-starti-api
# Criar o banco de dados
$ mysql -u root
mysql> CREATE DATABASE starti  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
$ php artisan migrate
$ php artisan db:seed

# Colocar em execução a API
$ php artisan serve
```

# Para rodar o front-end

- Com a API executando abrir outro terminal e :

```zsh
# Entrar na pasta da api
$ cd web
# Colocar em execução a a página
$ yarn serve
# ou
$ npm run serve
```
