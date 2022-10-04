PHP Docker servers boilerplate with databases and messages
===
Functional installation of Php environment using [Docker](https://www.docker.com).  

Usage
-----
Simply clone the repository and run it as a boilerplate for your project.
```
MY_APP=my_app git clone https://github.com/cylmat/php-docker-boilerplate --depth=1 $MY_APP && \
rm -rfi $MY_APP/.git && \
cd $MY_APP
```
You can then install your own application and tools, or you can use [https://github.com/cylmat/php-tools-boilerplate], from your host directory (dontt forget to place vendor directory in a container's "volume"), or directly inside your PHP container.

Versions of servers:
---
**Servers**  
* [Apache 2.4](https://httpd.apache.org)
* [Nginx 1.17](https://www.nginx.com)
* [PhpFpm 8.1](https://www.php.net/manual/fr/install.fpm.php)

**Databases**  
* [DBA Php](https://www.oracle.com/database/berkeley-db/db.html)
* [MariaDb 10.0](https://mariadb.org)
* [Memcached 1.6](https://memcached.org)
* [Mysql 5.7](https://www.mysql.com)
* [PostgreSql 12.4](https://www.postgresql.org)
* [Redis 6.0](https://redis.io)
* [SQlite 3](https://www.sqlite.org)

**Messages**  
* [Rabbitmq 3.8](https://www.rabbitmq.com)

**Proxies**  
* [HAProxy 2.2](http://www.haproxy.org)
* [Varnish 6.0](https://varnish-cache.org)

## See also
* [cylmat/php-tools-boilerplate](https://github.com/cylmat/php-tools-boilerplate/) - PHP dev configuration, specs and testing frameworks for PHP.
