## Instruções para desenvolvedores

Este repositório é um com duas pastas principais:
- `frontend/` — esqueleto mínimo Angular + TypeScript + Tailwind (componente `AuthComponent` inicial)
- `backend/` — scaffold no estilo Laravel (controlador, model, migration, routes)

Abaixo estão as ferramentas recomendadas e um passo-a-passo para colocar o projeto em execução no Windows (PowerShell).

### Pré-requisitos (instalar)
- PHP >= 8.0
- Composer (gerenciador PHP)
- Node.js >= 16 e npm
- Angular CLI (opcional, recomendado) — `npm install -g @angular/cli`
- PostgreSQL (servidor de banco de dados)
- Git

### Preparar o backend (Laravel) — passos mínimos
O repositório já contém uma aplicação Laravel (ver `backend/artisan`). Não é necessário criar um novo projeto — siga os passos abaixo para colocar o backend em execução localmente.

1. No PowerShell, dentro da pasta `backend` (ou use o placeholder do repositório):

```powershell
cd <REPO_ROOT>/backend
composer install          # instala dependências (cria vendor/)
copy .env.example .env    # copie e edite as variáveis de ambiente
# editar .env: DB_CONNECTION=pgsql, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
```

2. Criar o banco (se ainda não existir):

```powershell
psql -U postgres -c "CREATE DATABASE agueda_local;"
```

3. Rodar migrations e seeders (se houver):

```powershell
php artisan migrate
```

4. Iniciar o servidor local do Laravel:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

### Preparar o frontend (Angular) — passos mínimos
1. No PowerShell:

```powershell
## Instruções para desenvolvedores (resumo e fluxo de trabalho)

Este repositório contém o frontend em Angular e o backend em Laravel/Postgres. A seguir há instruções práticas para quem vai desenvolver, incluindo como executar o projeto localmente, convenções de commit/branch e links para os arquivos mais importantes.

### Pré-requisitos (instalação)
- PHP >= 8.0 + ext-pgsql
- Composer
- Node.js >= 16 e npm
- Angular CLI (opcional): `npm install -g @angular/cli`
- PostgreSQL
- Git

Usar PowerShell no Windows — todos os comandos abaixo são compatíveis com PowerShell.

### Preparar e rodar (passo a passo rápido)
1) Backend (Laravel)

```powershell
cd <C:\SEU_USER>\Agueda-Local\backend
composer install          # instala dependências PHP
copy ..\backend\.env.example .env  # copie e ajuste se necessário
# configurar .env: DB_CONNECTION=pgsql, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
php artisan key:generate
php artisan migrate       # aplica migrations (crie o DB no Postgres antes)
php artisan serve --host=127.0.0.1 --port=8000
```

2) Frontend (Angular)

```powershell
cd <REPO_ROOT>/frontend
npm install
ng serve --open           # inicia dev server (default: http://localhost:4200)
```

### Banco de dados (Postgres)
- Criar DB (psql):

```powershell
psql -U postgres -c "CREATE DATABASE agueda;"
```

- Migrations: `php artisan migrate` (rodar dentro da pasta `backend`).


### Como rodar localmente (exemplo de sessão de desenvolvimento)
1. Iniciar Postgres e criar DB `agueda`.
2. No `backend`: `composer install`, ajustar `.env`, `php artisan migrate`, `php artisan serve`.
3. No `frontend`: `npm install`, `ng serve`.
4. Testar fluxo de registro/login via `frontend` apontando para `http://127.0.0.1:8000/api`.
