@echo off
echo Iniciando setup local da API VS...
if not exist composer.json (
  echo Execute este script dentro do diretorio do seu projeto Laravel.
  pause
  exit /b 1
)
composer install
if not exist .env (
  copy .env.example .env
  echo Arquivo .env criado a partir de .env.example
) else (
  echo .env ja existe. Verifique as credenciais do banco antes de prosseguir.
)
php artisan key:generate
php artisan migrate --force
php artisan storage:link  || echo ignore
echo Setup concluido. Iniciando servidor local...
php artisan serve --host=127.0.0.1 --port=8000
pause
