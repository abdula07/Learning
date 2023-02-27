build:
	docker build -t learning .
	bash ./docker/run.sh
	docker exec learning bash /var/www/launch.sh
	docker exec learning bash /var/www/configure.sh
	make migrate

exec:
	docker exec -it learning /bin/bash

drop:
	docker stop learning
	docker rm learning

drop-all:
	make drop
	docker rmi learning

rebuild:
	make drop
	make build

start:
	docker start learning
	docker exec learning bash /var/www/launch.sh

stop:
	docker stop learning

restart:
	make stop
	make start

migrate:
	docker exec learning php /var/www/learning/yii migrate

fix-rights:
	docker exec learning chown -R 1000:1000 /var/www/learning
	docker exec learning chmod -R 0777 /var/www/learning

services-start:
	docker exec learning php /var/www/learning/yii services/start

services-stop:
	docker exec learning php /var/www/learning/yii services/stop

services-restart:
	docker exec learning php /var/www/learning/yii services/stop
	docker exec learning php /var/www/learning/yii services/start

