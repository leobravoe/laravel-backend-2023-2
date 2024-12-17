Comandos para configurar o projeto:

# Navegar para o diretório onde o projeto será configurado
cd documents

# Clonar o repositório do projeto do GitHub para a máquina local
git clone https://github.com/leobravoe/laravel-backend-2023-2.git

# Acessar o diretório do projeto recém-clonado
cd laravel-backend-2023-2

# Atualizar as dependências do projeto usando o Composer (gerenciador de dependências do PHP)
composer update

# Copiar o arquivo de exemplo .env para criar o arquivo de configuração .env
copy .env.example .env

# Gerar uma chave de aplicação única para o projeto Laravel
php artisan key:generate

# Editar o arquivo .env para configurar o nome da base de dados como "restaurantedb"
# (Este passo é feito manualmente, abrindo o arquivo .env em um editor de texto)
# DB_DATABASE=restaurantedb
Configurar o arquivo .env com o nome da base de dados "restaurantedb"

# Resetar e configurar o banco de dados utilizando um comando personalizado do Laravel
php artisan reset-database

Com o projeto configurado, para atualizar:

# Reverter todas as alterações locais ao último commit registrado
git reset --hard

# Remover arquivos ou diretórios não rastreados pelo Git
git clean -fd

# Obter as últimas atualizações do repositório remoto e aplicá-las ao local
git pull