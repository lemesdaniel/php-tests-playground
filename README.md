**Qual é o cenário?**

A empresa **Aulas Online Ltda** solicitou que você construa uma sala de aula virtual com capacidade de 25 usuários incluindo moderadores e alunos no plano free da startup.

A entrada na sala dá-se somente por meio da moderação do Anfitrião, opcionalmente o Anfitrião pode escolher uma pessoa para ser Co-Anfitrião e lhe auxiliar no gerenciamento da sala.

Somente o Anfitrião ou Co-Anfitrião poderá desativar o som do microfone dos usuários conectados, ele poderá optar por silenciar um usuário específico ou todos.

A entrada de qualquer usuário deve ser liberada pelo Anfitrião.

Quando a sala completar o limite máximo de usuários, o próximo á chegar, deverá ser adicionado na sala de espera.

O Anfitrião pode contratar um novo plano para conseguir adicionar novos usuários na sala virtual, o pagamento deve ser feito via PIX.

Os planos estão disponíveis nos seguintes períodos: mensal, semestral e anual; No plano semestral, adicionar um desconto de 5% e 15% no anual.

**Requisitos:**

- O Anfitrião e demais usuários devem estar previamente cadastrado na plataforma.
- O usuário só poderá participar de uma sala virtual por vez.
- O usuário poderá ir para uma nova sala, porém deverá ser desconectado da sala anterior.

Inicia Docker docker-compose up -d

Encerrar Doker docker-compose down

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

[x] Aumentar capacidade da sala.

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

### Entidades

Room
User
Plan
