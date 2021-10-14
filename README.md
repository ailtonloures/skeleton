<h1 align="center">Skeleton</h1>

## Sobre

Estrutura inicial para projetos desenvolvidos em PHP.

## O que você verá no projeto 

***Atenção: Qualquer dúvida que tenha no projeto. Leia a documentação desses componentes.***

- Routes - [Slim](http://www.slimframework.com/docs/v3/)
- Events e Listeners - [League](https://event.thephpleague.com/2.0/)
- Mailer - [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- Validator - [Documentação](https://github.com/ailtonloures/validator)
- Template Enginer - [PHP-View](https://github.com/slimphp/PHP-View)
- Carbon - [Documentação](https://carbon.nesbot.com/docs/)
- Tests - [Pest](https://pestphp.com/)

## Requisitos

Requisitos obrigatórios para o funcionamento do projeto

- Composer
- PHP ^7.2

## Instalação

Com o composer instalado na sua máquina, execute o comando abaixo:

```
composer create-project --prefer-dist --stability dev ailtonloures/skeleton [app_name]
```

## Iniciando projeto

Após ter realizado todas as configurações acima, suba o seu servidor apache (XAMPP, WAMPP, etc...) ou execute o comando a seguir na raiz do seu projeto.
A porta pode ser de sua preferência ou a porta que estiver disponível em seu servidor, mas por padrão, será a porta 80.

```
composer run start
```

Este comando irá subir um servidor local na porta 80, basta abrir o navegador e acessar http://localhost
