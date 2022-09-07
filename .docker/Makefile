SHELL := /bin/bash

###
# Compose
###
compose-db:
	docker-compose -f ../docker-compose-db.yml --env ../.env up --build -d

compose-fpm:
	docker-compose -f ../docker-compose-fpm.yml --env ../.env up --build -d

compose-proxy:
	docker-compose -f ../docker-compose-proxy.yml --env ../.env up --build -d

compose-srv:
	docker-compose -f ../docker-compose-srv.yml --env ../.env up --build -d

###
# Config
###
apache-config:
	@mkdir --parents server/apache/extra
	docker run --rm httpd:2.4 cat conf/httpd.conf > server/apache/orig-httpd.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-default.conf > server/apache/extra/orig-httpd-default.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-userdir.conf > server/apache/extra/orig-httpd-userdir.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-ssl.conf > server/apache/extra/orig-httpd-ssl.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-vhosts.conf > server/apache/extra/orig-httpd-vhosts.conf

nginx-config:
	@mkdir --parents server/nginx/conf.d
	docker run --rm nginx:1.23 cat etc/nginx/nginx.conf > server/nginx/orig-nginx.conf
	docker run --rm nginx:1.23 cat etc/nginx/conf.d/default.conf > server/nginx/conf.d/orig-default.conf

###
# Check
###
check-dbsql:
	docker exec fpm bash -c "php -f '/var/www/shell/check-dbsql.php'"

check-dbkv:
	docker exec fpm bash -c "php -f '/var/www/shell/check-dbkv.php'"

check-fpm:
	docker exec fpm bash -c "php -v && php-fpm7.4 -v"

check-mq:
	docker exec -e SERVER=1 fpm bash -c "php -f '/var/www/shell/check-mq.php' &"
	docker exec fpm bash -c "php -f '/var/www/shell/check-mq.php'"

check-proxy:
	docker exec haproxy bash -c "apt-get update && apt-get install -y curl"
	docker exec haproxy bash -c "curl localhost:80/check-proxy.php"

# need fpm running
check-srv:
	docker exec apache bash -c "apt-get update && apt-get install -y curl && curl localhost:80"
	docker exec nginx bash -c "apt-get update && apt-get install -y curl && curl localhost:80"

###
# list
###
image-list:
	docker image ls

container-list:
	docker container ls

container-ps:
	docker container ps -a