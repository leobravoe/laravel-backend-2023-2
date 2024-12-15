git clone https://github.com/leobravoe/laravel-backend-2023-2.git

cd laravel-dsw2-2024-2

composer update

copy .env.example .env

php artisan key:generate

Configurar o arquivo .env com o nome da base de dados "restaurantedb"

php artisan reset-database

Com o projeto configurado, para atualizar:

git reset --hard

git clean -fd

git pull