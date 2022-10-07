PHP Docker servers boilerplate with databases and messages
===
Functional installation of Php environment using [Docker](https://www.docker.com).  

Usage
-----
* Simply clone the repository and run it as a boilerplate for your project.  
1.
```
export APP_DIR=app_dir
```

2.
```
git clone https://github.com/cylmat/php-docker-boilerplate --depth=1 $APP_DIR
rm -rf $APP_DIR/.git
unset APP_DIR

```
* You can then install your own application and tools, or you can use [cylmat/php-tools-boilerplate](https://github.com/cylmat/php-tools-boilerplate)  
from your host directory (don't forget to place vendor directory in a container's "volume"),  
or directly inside your PHP running container.

* Change the values of .env file "HOST_DIRECTORY" and "APP_SOURCE_PATH" if you need it.

* Run "**git init**" from inside your application directory to create a git repository.

* You can use the Home's Makefile in the Phpfpm's container to configure the prompt or vim editor, e.g.
```
cd ~
~ make bash-it
~ make bash-git
~ make fancy-git
~ make vim-basic
```

Versions of servers:
---
**Servers**  
* [Apache](https://httpd.apache.org)
* [Nginx](https://www.nginx.com)
* [PhpFpm](https://www.php.net/manual/fr/install.fpm.php)

**Databases**  
* [DBA](https://www.oracle.com/database/berkeley-db/db.html)
* [MariaDb](https://mariadb.org)
* [Memcached](https://memcached.org)
* [Mysql](https://www.mysql.com)
* [PostgreSql](https://www.postgresql.org)
* [Redis](https://redis.io)
* [SQlite](https://www.sqlite.org)

**Messages**  
* [Rabbitmq](https://www.rabbitmq.com)

**Proxies**  
* [HAProxy](http://www.haproxy.org)
* [Varnish](https://varnish-cache.org)

## See also
* [cylmat/php-tools-boilerplate](https://github.com/cylmat/php-tools-boilerplate/) - PHP dev configuration, specs and testing frameworks for PHP.
