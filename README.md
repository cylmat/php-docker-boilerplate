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
3. Change the values of .env file "HOST_DIRECTORY" and "APP_SOURCE_PATH" if you need it.
4. _You can choose to dev from your Host directory (application's files sync with Host),  
   or directly in your Phpfpm's running container (application's files in a Docker's volume)_  
   _(If you use a Docker volume, you may clone this repository inside to commit it with your application code)_
- Run the docker-compose-*.yml to load the Docker containers.
- Run "**_git init_**" to create a new git repository. 
- You can install your own application and tools, or you can use [cylmat/php-tools-boilerplate](https://github.com/cylmat/php-tools-boilerplate)  
```
docker-compose -f "docker-compose-server.yml" up
docker-compose -f "docker-compose-db.yml" up
```
5. Your application will be accessible from http://your-docker-address:8001 for Apache

* You can use the Home's Makefile to configure the prompt or vim editor, e.g.
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
