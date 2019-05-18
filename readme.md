# WebEstoque
## Sistema demonstração de Controle de Estoque Simples desenvolvido em Laravel

Este sistema destina-se a ser uma base de estudo para os meus alunos da Fatec. Foi desenvolvido com o framework Laravel em sua versão 5.5.

## Pacotes de terceiros utilizados
- Widgets - arrilot/laravel-widgets - versão:  ^3.13
- Gravatar - creativeorange/gravatar - versão: ^1.0
- Faker - fzaninotto/faker - versão: ^1.8
- AdminLte - jeroennoten/laravel-adminlte - versão: ^1.25

## Processo de instalação

1. Clonar o projeto através do comando
```bash
git clone https://github.com/fsclaro/WebEstoque.git
```

2. Estando no diretório do projeto, executar os seguintes comandos
```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
````
Após a execução destes passos, o sistema estará em condições de uso. Para isto, suba o servidor interno do Laravel

```bash
php artisan serve
````

Abra o seu navegador e aponte para o endereço http://127.0.0.1:8000

Já existem alguns dados gerados. Para acesso inicial, utilize a seguinte credencial:

E-mail: admin@admin.com
Senha: admin1234
