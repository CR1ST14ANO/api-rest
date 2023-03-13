
# Setup

### Passo a passo
Clone Repositório
```sh
git clone  https://github.com/CR1ST14ANO/api-rest
```

```sh
cd api-rest/
```

Remova o versionamento
```sh
rm -rf .git/
```


Copie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=Laravel9
APP_URL=http://localhost:8180

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=cbc
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```
Para Instalar o Docker no ubuntu
https://docs.docker.com/engine/install/ubuntu/

Após criar e atualizar a .env do projeto, execute o comanando para buildar os containers
```sh
docker compose build --no-cache
```

Suba os containers do projeto
```sh
docker compose up -d
```


Acessar o container
```sh
docker compose exec app bash

```

Instalar as dependências do projeto
```sh
composer install
```

Após Acessar o container rodar as migrations e seeders
```sh
php artisan migrate:install

```

```sh
php artisan migrate

```

```sh
php artisan db:seed

```

Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost:8989](http://localhost:8989)

Não foi implementado nenhuma segurança na aplicação.
Gosto de utilizar o JWT Token para autenticação das requisições.

