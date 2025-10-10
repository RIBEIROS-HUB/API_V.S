        # API Victoria's Secret - Projeto base Laravel (Local)

        Este pacote contém os arquivos essenciais para integrar a API de produtos em um projeto Laravel local (XAMPP, Laragon, Valet, etc.).

## O que está incluído
- app/Models/Produto.php
- app/Http/Controllers/ProdutoController.php
- database/migrations/2025_10_06_000000_create_produtos_table.php
- routes/api.php
- .env.example
- composer.json (stub)
- scripts/run_local.sh  (Linux / macOS)
- scripts/run_local.bat (Windows)

## Instruções rápidas (Linux / macOS)
1. Crie um projeto Laravel (ou entre no seu projeto existente):
   ```bash
   composer create-project laravel/laravel vs_api
   cd vs_api
   ```
2. Copie os arquivos deste pacote para o diretório do projeto (substitua quando solicitado).
3. Copie `.env.example` para `.env` e ajuste as credenciais do banco de dados.
4. Execute o script de configuração (requer composer e php no PATH):
   ```bash
   bash scripts/run_local.sh
   ```

## Instruções rápidas (Windows PowerShell)
1. Crie um projeto Laravel (ou entre no seu projeto existente):
   ```powershell
   composer create-project laravel/laravel vs_api
   cd vs_api
   ```
2. Copie os arquivos deste pacote para o diretório do projeto (substitua quando solicitado).
3. Copie `.env.example` para `.env` e ajuste as credenciais do banco de dados.
4. Execute o script de configuração (abra PowerShell como Administrador se necessário):
   ```powershell
   .\\scripts\\run_local.bat
   ```

## O que o script faz
- instala dependências (`composer install`)
- copia `.env.example` para `.env` se não existir
- gera a APP_KEY (`php artisan key:generate`)
- executa migrations (`php artisan migrate`)
- cria link simbólico para storage (`php artisan storage:link`)
- inicia o servidor (`php artisan serve`)

> Observação: ajuste as variáveis DB no arquivo `.env` antes de rodar se estiver usando MySQL local (XAMPP/Laragon). Para testes rápidos com SQLite, modifique `DB_CONNECTION=sqlite` e crie o arquivo `database/database.sqlite`.
