SHELL := /bin/bash

###
# Compose
###
.PHONY: compose-db compose-fpm compose-proxy compose-srv

compose-databases:
	docker-compose -f ../docker-compose-db.yml --env ../.env up --build -d

compose-proxy:
	docker-compose -f ../docker-compose-proxy.yml --env ../.env up --build -d

compose-server:
	docker-compose -f ../docker-compose-server.yml --env ../.env up --build -d

###
# Config
# To bash and try, use "docker run --rm <image:version> -it bash"
###
all-config:
	@make apache-config
	@make nginx-config
	@make phpfpm-config
	@make mariadb-config
	@make mysql-config

##########
# SERVER #
##########
apache-config:
	@mkdir --parents default-conf/server/apache/extra
	docker run --rm httpd:2.4 cat conf/httpd.conf > default-conf/server/apache/httpd.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-default.conf > default-conf/server/apache/extra/httpd-default.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-userdir.conf > default-conf/server/apache/extra/httpd-userdir.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-ssl.conf > default-conf/server/apache/extra/httpd-ssl.conf
	docker run --rm httpd:2.4 cat conf/extra/httpd-vhosts.conf > default-conf/server/apache/extra/httpd-vhosts.conf

nginx-config:
	@mkdir --parents default-conf/server/nginx/conf.d
	docker run --rm nginx:1.23 cat etc/nginx/nginx.conf > default-conf/server/nginx/nginx.conf
	docker run --rm nginx:1.23 cat etc/nginx/conf.d/default.conf > default-conf/server/nginx/conf.d/default.conf

phpfpm-config:
	@mkdir --parents default-conf/server/phpfpm/php-fpm.d
# Relative with workspace "/var/www/html"
	docker run --rm php:8.1-fpm cat ../../../usr/local/etc/php/php.ini-development > default-conf/server/phpfpm/php.ini
	docker run --rm php:8.1-fpm cat ../../../usr/local/etc/php-fpm.conf > default-conf/server/phpfpm/php-fpm.conf
	docker run --rm php:8.1-fpm cat ../../../usr/local/etc/php-fpm.d/www.conf > default-conf/server/phpfpm/php-fpm.d/www.conf

############
# Database #
############
mariadb-config:
	@mkdir --parents default-conf/data/mariadb/mariadb.conf.d
	docker run --rm mariadb:10.7 cat etc/mysql/my.cnf > default-conf/data/mariadb/my.cnf
	docker run --rm mariadb:10.7 cat etc/mysql/mariadb.cnf > default-conf/data/mariadb/mariadb.cnf
	docker run --rm mariadb:10.7 cat etc/mysql/mariadb.conf.d/50-client.cnf > default-conf/data/mariadb/mariadb.conf.d/50-client.cnf
	docker run --rm mariadb:10.7 cat etc/mysql/mariadb.conf.d/50-server.cnf > default-conf/data/mariadb/mariadb.conf.d/50-server.cnf

mysql-config:
	@mkdir --parents default-conf/data/mysql
	docker run --rm mysql:8.0 cat etc/my.cnf > default-conf/data/mysql/my.cnf

###
# Check
###
check-dbsql:
	docker exec fpm bash -c "php -f '/var/www/shell/check-dbsql.php'"

check-dbkv:
	docker exec fpm bash -c "php -f '/var/www/shell/check-dbkv.php'"

# check-phpfpm:
# 	docker exec fpm bash -c "php -v && php-fpm8.0 -v"

# check-mq:
# 	docker exec -e SERVER=1 fpm bash -c "php -f '/var/www/shell/check-mq.php' &"
# 	docker exec fpm bash -c "php -f '/var/www/shell/check-mq.php'"

check-proxy:
	docker exec haproxy bash -c "apt update && apt install -y curl && curl localhost:80"
	docker exec haproxy bash -c "curl localhost:80/check-proxy.php"

# Need PhpFpm running
# check-server:
# 	docker exec apache bash -c "apt-get update && apt-get install -y curl && curl localhost:80"
# 	docker exec nginx bash -c "apt-get update && apt-get install -y curl && curl localhost:80"
