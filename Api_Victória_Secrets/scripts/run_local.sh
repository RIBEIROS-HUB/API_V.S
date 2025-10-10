#!/usr/bin/env bash
set -e
echo "Iniciando setup local da API VS..."

if [ ! -f composer.json ]; then
  echo "Atenção: execute este script dentro do diretório do projeto Laravel (onde está o composer.json)."
  exit 1
fi

composer install

if [ ! -f .env ]; then
  cp .env.example .env
  echo "Arquivo .env criado a partir de .env.example"
else
  echo ".env já existe. Verifique as credenciais do banco antes de prosseguir."
fi

php artisan key:generate
php artisan migrate --force
php artisan storage:link || true

echo "Setup concluído. Iniciando servidor local..."
php artisan serve --host=127.0.0.1 --port=8000
