# Base-Structure

## Sobre

É um projeto totalmente livre, não é literalmente é framework e sim uma estrutura pronta e padronizada pra quem prefere no seu dia a dia 
trabalhar com a linguagem PHP sem o uso de framework e ficar preso a isso. 
Cada arquivo, classes e etc, podem ser alterados por você para melhorar e adaptar da melhor forma e adequada ao seu projeto, 
ou você pode contribuir com novas features, correções de bugs, e outros que você achar que pode ser melhorado para ideia do projeto inicial.

## Requisitos

Requisitos obrigatórios para o funcionamento do projeto

- Composer
- PHP ^7.2

## Instalação

Com o composer instalado na sua máquina, execute o comando abaixo:

```
composer create-project --prefer-dist --stability dev ailtonloures/base-structure [app_name]
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

## O que você verá no projeto

- Events e Listeners
- Mailer
- FileSystem
- PDF
- SEO
- Validator
- Pusher Notification
- Response
- Template Enginer (PHPRenderer)
- Pipelines
- Helpers

## O que pode vir de novidade ou contribuído por você

- Queue e Jobs
...

Divirta-se!
