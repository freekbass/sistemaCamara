# sistemaCamara
Teste prático para a Virtualiza

# Instalação 

Instalar composer pelo site https://getcomposer.org/download/

##Instalação do projeto

```
composer install
```

## banco de dados
Criar um banco de dados no Mysql, sem nenhuma alteração (banco zerado)
Acessar a pasta do projeto e altear o arquivo .env com os dados do banco gerado:
Ex:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=camara
DB_USERNAME=root
DB_PASSWORD=
```

Abrir Propmt do Windows e acessar o diretorio raiz do projeto e rodar:
```
php artisan migrate
```

##Executar Projeto

Obs: executar o projeto pelo server do Artisan, por questão de rotas configuradas no projeto.
Para rodar em outro servidor, tem q ser configurado pra rodar em \
```
php artisan serve
```
