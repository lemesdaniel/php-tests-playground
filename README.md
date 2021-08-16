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


*** Casos de testes ***

[x] Verificar se a capacidade máxima é de 25 pessoas.
[x] Aumentar capacidade da sala
[X] Verificar se anfitrião consegue criar sala
[X] Verificar a negação do usuário comum para criar sala
[ ] Verificar se apenas o anfitrição/co-anfitrião consegue adicionar usuários.
[ ] Verificar se anfitrição consegue silenciar todos da sala.
[ ] Verificar se anfitrição consegue silenciar um usuário da sala.

[ ] Não permitir a entrada do usuário sem aprovação do anfitrião.
[ ] Se sala cheia enviar o usuário para sala de espera.

[ ] Anfitrião pode aumentar a capacidade da sala.
[ ] Verificar se o plano trimetral concede 5% de desconto.
[ ] Verificar se o plano anual concede 15% de desconto.
[ ] Não permitir que usuário fique em duas salas.

*** Entidades ***

Room
User
Plan
