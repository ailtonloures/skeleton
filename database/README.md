# Como usar o Phinx

## Migrations

Para criação das migrations execute o comando abaixo:

```
vendor/bin/phinx create NomeDaMigration --path database/migrations --configuration config/database.php
```

Para execução das migrations:

```
vendor/bin/phinx migrate --environment nome-do-enviroment --configuration config/database.php
```

Para realizar o rollback das migrations:

```
vendor/bin/phinx rollback --environment nome-do-enviroment --configuration config/database.php
```

- **--environment** ou **-e** recebe o environment do banco de dados, seja **prod, dev ou test**
- **--path** ou **-p** recebe o caminho de onde será ou onde está criada a migration
- **--configuration** ou **-c** recebe o caminho de onde está localizada a configuração do banco de dados

## Seeds 

Para a criação das seeds execute o comando abaixo:

```
vendor/bin/phinx seed:create NomeDaSeed --path database/seeds --configuration config/database.php
```

Para execução das seeds:

```
vendor/bin/phinx seed:run --configuration config/database.php --environment nome-do-enviroment
```

- **--environment** ou **-e** recebe o environment do banco de dados, seja **prod, dev ou test**
- **--path** ou **-p** recebe o caminho onde será ou onde está criada a seed
- **--configuration** ou **-c** recebe o caminho de onde está localizada a configuração do banco de dados