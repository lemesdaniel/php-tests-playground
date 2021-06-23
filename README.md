Inicia Docker
docker-compose up -d

Encerrar Doker
docker-compose down

Levantar o docker com rebuild do container
docker-compose up -d --build

Entrar no shell do container
docker exec -it php-training-php /bin/sh
docker exec -it php-training-php /bin/bash

Verificar os logs de acesso do nginx
docker logs -tf php-training-php

Acessando no navegador
http://phptraining.local:8000/