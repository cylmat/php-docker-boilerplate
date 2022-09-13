SHELL := /bin/bash

###
# Compose
###
.PHONY: compose-db compose-server check

compose-db:
	cd .. && docker-compose -f "docker-compose-db.yml" up -d --build --force-recreate

compose-server:
	cd .. && docker-compose -f "docker-compose-server.yml" up -d --build --force-recreate

check-install:
	docker exec phpfpm curl apache:80?check
	docker exec phpfpm curl nginx:80?check

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
# Relative with workspace "/var/www/html"
	@mkdir --parents default-conf/server/phpfpm/php-fpm.d
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
