#!/bin/bash
set -e

echo "=== Estúdio Norra - Deploy Hostinger Shared Hosting ==="

# 1. Instalar dependências de produção do Composer
echo "-> Instalando dependências PHP otimizadas..."
composer install --no-dev --optimize-autoloader --no-interaction

# 2. Gerar build de assets estáticos (se Node estiver disponível)
if command -v npm &> /dev/null; then
    echo "-> Compilando assets do Tailwind CSS e Vite..."
    npm install --omit=dev
    npm run build
fi

# 3. Garantir banco de dados SQLite ou MySQL
if [ ! -f database/database.sqlite ] && grep -q "DB_CONNECTION=sqlite" .env; then
    echo "-> Criando banco de dados SQLite inicial..."
    touch database/database.sqlite
fi

# 4. Executar Migrações
echo "-> Executando migrações do banco de dados..."
php artisan migrate --force --no-interaction

# 5. Criar link simbólico do storage
echo "-> Conectando storage público..."
php artisan storage:link || true

# 6. Otimizar caches do Laravel para produção
echo "-> Limpando e gerando caches de alta performance..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "=== Deploy finalizado com sucesso! ==="
