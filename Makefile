up:
    docker-compose up -d

down:
    docker-compose down

build:
    docker-compose build

logs:
    docker-compose logs -f

bash-php:
    docker-compose exec php bash

bash-node:
    docker-compose exec node bash

bash-mysql:
    docker-compose exec mysql bash

init: build up
    @echo "Projet démarré avec succès !"