PHP Docker servers boilerplate with databases and messages
===
Functional installation of Php environment using [Docker](https://www.docker.com).  

Usage
-----
Simply clone the repository and run it as a boilerplate for your project.
```
export MY_APP=my_app && \
git clone https://github.com/cylmat/php-docker-boilerplate --depth=1 $MY_APP && \
rm -rf $MY_APP/.git && \
cd $MY_APP && \
unset MY_APP
```
You can then install your own application and tools, or you can use
[https://github.com/cylmat/php-tools-boilerplate]
from your host directory (don't forget to place vendor directory in a container's "volume"), or directly inside your PHP container.

* Use the Makefile in the Phpfpm's container to configure the prompt or vim editor, e.g.
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
