# Base-Structure

## Instalação

Abra o terminal e clone o repositório. Substitua "my-project" pelo nome do seu projeto.

```
git clone https://github.com/ailtonloures/base-structure.git my-project
```

Ainda no terminal, faça a instalação das depedências usando o composer.

```
composer install
```

## Configuração

Após a instalação das dependências, copie e cole o arquivo .env.example e renomeie para .env.

``` 
# App
APP_NAME=YourApp
APP_HOST=http://localhost
APP_PATH=public
APP_LOCALE=pt_BR

# Slim
DISPLAY_ERROR_DETAILS=true
ADD_CONTENT_LENGTH_HEADER=false

# Database
DB_DRIVER=
DB_HOST=
DB_NAME=
DB_PORT=
DB_USERNAME=
DB_PASSWORD=

# Mail
MAIL_HOST=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_PORT=
MAIL_CRYPT=
MAIL_FROM=
MAIL_NAME=

# Auth
JWT_SECRET_KEY=

# Pusher
CLUSTER=
AUTH_KEY=
SECRET=
APP_ID=
MASTER_KEY=

# SEO & SMO
FB_PAGE=
FB_AUTHOR=
FB_APP_ID=
TWITTER_CREATOR=
TWITTER_SITE=
TWITTER_DOMAIN=
TWITTER_CARD=
``` 

## Usar

Após ter realizado todas as configurações acima, suba o seu servidor apache (XAMPP, WAMPP, etc...) ou execute o comando a seguir na raiz do seu projeto.
A porta pode ser de sua preferência ou a porta que estiver disponível em seu servidor, mas por padrão, de exemplo será a porta 80.

```
composer start
```

Este comando irá subir um servidor local na porta 80, basta abrir o navegador e acessar http://localhost

## Testes

Para executar os testes unitários, execute o comando:

```
composer test
```

Divirta-se!
