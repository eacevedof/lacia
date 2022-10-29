#!/bin/bash
TODAY := $(shell date +'%Y%m%d')
OS := $(shell uname)

help: ## Show this help message
	@echo "usage: make [target]"
	@echo
	@echo "targets:"
	@egrep "^(.+)\:\ ##\ (.+)" ${MAKEFILE_LIST} | column -t -c 2 -s ":#"

rebuild-all: ## rebuild containers
	docker-compose -f docker-compose.yml down
	docker-compose -f docker-compose.yml up -d --build --remove-orphans

destroy-all: ## destroy containers
	docker-compose -f docker-compose.yml down

rebuild-web: #nginx
	docker-compose up -d --no-deps --force-recreate --build web
	docker ps

rebuild-php: #fpm
	docker-compose up -d --no-deps --force-recreate --build php
	docker ps

restart-docker: ## restart docker
	# systemctl restart docker
	killall Docker && open /Applications/Docker.app

restart-all: ## restart the containers
	docker-compose stop
	docker-compose start

restart-php:
	docker restart contphp

restart-web:
	docker restart contweb

stop: ## stop containers
	docker-compose stop

stop-php: ## stop be
	docker stop contphp

stop-web: ## stop web
	docker stop contweb

logs-web: ## logs web
	docker logs contweb

logs-php: ## logs be
	docker logs contphp

rem-cache: ## remove diskcache
	rm -fr ./apps/lumen/storage/framework/cache/data/* !.gitignore

ssh-php: ## fpm
	docker exec -it --user root contphp bash

ssh-web: ## web
	docker exec -it --user root contweb bash

log-error: ## logs error
	cd ./apps/lumen/storage/logs; \
	rm -f *.log; touch lumen-${TODAY}.log; clear; \
	tail -f lumen-${TODAY}.log;

js-test:
	cd ./apps/vue; \
	npm run test:unit

js-serve: ## http://localhost:8081/
	cd ./apps/vue; npm run serve;

install-lumen:
	docker exec -it contphp sh -c 'cd /appdata/www/lumen/; composer update; '

install-vue:
	cd ./apps/vue; npm install; npm run build

php-test:
	docker exec -it contphp sh -c 'cd /appdata/www/lumen/; ./vendor/bin/phpunit'