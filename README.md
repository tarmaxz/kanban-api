# Kanban API - Setup com Docker

Este documento descreve o passo a passo para rodar o projeto Kanban API usando Docker e Docker Compose.

## Pré-requisitos

- Docker instalado (https://docs.docker.com/get-docker/)
- Docker Compose instalado (https://docs.docker.com/compose/install/)

## Passo a passo

### 1. Clonar o repositório

```bash
git clone <https://github.com/tarmaxz/kanban-api>
cd <kanban-api>
```

### 2. Configurar variáveis de ambiente

Copie o arquivo .env.example para .env e ajuste as variáveis conforme necessário:

```bash
cp .env.example .env
```

Ajuste principalmente as variáveis do banco de dados, por exemplo:

```
POSTGRES_DB=api_kanban
POSTGRES_USER=admin
POSTGRES_PASSWORD=admin
```

### 3. Construir e subir os containers

No diretório do projeto, execute:

```bash
docker-compose up --build
```

Isso vai:
- Construir a imagem kanban-api com base no Dockerfile
- Iniciar o container da aplicação PHP Laravel
- Iniciar o container do PostgreSQL
- Mapear as portas 8080 (host) para 8000 (container Laravel)
- Mapear a porta 15432 (host) para 5432 (container PostgreSQL)

### 4. Executar as migrations, seeders e configurar Laravel Passport

Em outro terminal, com os containers rodando, execute:

```bash
docker exec -it kanban-api bash
php artisan migrate --seed
php artisan passport:install
php artisan passport:client --password
```

Isso irá:
- Configurar o banco de dados com as tabelas e dados iniciais
- Instalar o Laravel Passport para autenticação da API
- Criar um client para autenticação via password grant (siga as instruções no terminal)

### 5. Acessar a aplicação

Abra seu navegador e acesse:

```
http://localhost:8080
```

## Observações

- O volume ./docker/postgres:/var/lib/postgresql/data mantém os dados do banco persistentes no host.
- Para parar os containers, use:
  ```bash
  docker-compose down
  ```
- Se quiser rodar em background, use:
  ```bash
  docker-compose up -d
  ```

---
