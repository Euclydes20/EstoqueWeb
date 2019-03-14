#!/bin/bash

clear

# Definindo cores para as mensagens
_green="\033[0;32m"
_yellow="\033[0;33m"
_white="\033[0;37;1m"
_normal="\033[0m"
_reset_color="\033[39m"


echo -e "${_yellow}➤${_normal} Configurando o git com os seus dados..."
echo -ne "   ${_green}✔${_normal} Forneça o seu nome completo: "
read seu_nome
git config user.name "$seu_nome"

echo -ne "   ${_green}✔${_normal} Forneça seu e-mail: "
read email
git config user.email "$email"

echo -ne "   ${_green}✔${_normal} git configurado..."

echo -e "\n${_yellow}${_normal} Instalando os pacotes do projeto..."
composer install

echo -e "\n${_yellow}✔${_normal} Verificando se o arquivo ${_yellow}.env${_normal} existe..."
if ! [ -a ".env" ]; then
    # se o arquivo .env não existe, então crie a partir do .env.example
    echo -e "    ${_yellow}✔${_normal} Arquivo ${_yellow}.env${_normal} não encontrado. Criando uma cópia a partir do arquivo ${_yellow}.env.example${_normal}..."
    cp .env.example .env 
fi

echo -e "\n${_yellow}✔${_normal} Ajustando os parâmetros do banco de dados no arquivo ${_yellow}.env${_normal}..."
sed 's/DB_DATABASE=homestead/DB_DATABASE=db_estoque/g' .env > .env1
sed 's/DB_USERNAME=homestead/DB_USERNAME=fatec/g' .env1 > .env2
sed 's/DB_PASSWORD=secret/DB_PASSWORD=fatec/g' .env2 > .env
rm .env1
rm .env2

echo -e "\n${_yellow}✔${_normal} Gerando a chave da aplicação..."
php artisan key:generate

echo -e "\n${_yellow}✔${_normal} Criando o banco de dados..."
mysql -u fatec -p < scripts/cria_db.sql

echo -e "\n${_yellow}✔${_normal} Criando as tabelas no banco de dados..."
php artisan migrate

echo "Pronto!!"
