# Test Ewill Symfony :tada:

## Commencer

### Installer les dépendances

```bash
composer install
```

```bash
yarn install
```

### Compiler les assets

```bash
yarn dev
```

### Base de données

> La base de données fonctionne avec docker.

Lancer la base de données via Docker : 

```bash
docker-compose up -d
```

Créer la base de données :

```bash
symfony console doctrine:database:create
```

Appliquer les migrations :

```bash
symfony console doctrine:migrations:migrate
```

Charger les données de test :

```bash
symfony console doctrine:fixtures:load
```

### Démarrer l'application

> Pour démarrer l'application, il faut installer `symfony`, vous pouvez l'installer via :
> `wget https://get.symfony.com/cli/installer -O - | bash`

```bash
symfony serve
```

Le site est disponible à l'adresse [localhost:8000](http://localhost:8000).

## Développeurs
* **Romain HERAULT** - *Développeur* - [r.herault](https://rherault.fr)
