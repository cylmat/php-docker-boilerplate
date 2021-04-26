##############
# DOCKER PHP #
# @see https://hub.docker.com/_/php
#
# Use this Dockerfile as a base template,
# (Un)comment extensions for your need on your own application.
#
# Use "docker run --rm -it php:8.1-fpm bash" to try your own installation
##############

### Debian GNU/Linux 11 (bullseye) ###
FROM php:8.1-fpm AS CORE

ARG DEBIAN_FRONTEND=noninteractive
RUN apt update

### Common and build (https://packages.debian.org) ###
RUN apt install -y \
    bzip2 \
    curl \
    git \
    gnupg \
    sqlite3 \
    wget \
    vim \
    zip

RUN apt install -y \
    apt-utils \
    autoconf \
    gcc \
    libc6-dev \
    make \
    pkg-config \
    software-properties-common

###
### Busybox (https://busybox.net)
### and network tools (ifconfig ping netstat nslookup...)
###
RUN apt install -y busybox dnsutils iputils-ping netcat net-tools nmap tcpdump telnet

###
### Language
###
#RUN apt install -y lua5.4 && lua -v
RUN php -v && perl -v

##################
# PHP extensions #
##################

FROM CORE AS EXT

# Already installed extensions "php -m" :
# ctype curl date dom fileinfo filter ftp hash iconv json libxml mbstring mysqlnd openssl pcre pdo pdo_sqlite Phar
# posix readline Reflection session SimpleXML sodium spl sqlite3 standard tokenizer xml xmlreader xmlwriter zlib
# 
# Available extensions with "docker-php-ext-install" :
# bcmath bz2 calendar ctype curl dba dl_test dom enchant exif ffi fileinfo filter ftp gd gettext gmp hash iconv
# imap intl json ldap mbstring mysqli oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc
# pdo_pgsql pdo_sqlite pgsql phar posix pspell readline reflection session shmop simplexml snmp soap sockets sodium
# spl standard sysvmsg sysvsem sysvshm tidy tokenizer xml xmlreader xmlwriter xsl zend_test zip
#
# Extensions installed with docker-php-ext automatically created
# /usr/local/etc/php/conf.d/docker-php-ext-***.ini 
##################

RUN apt install -y \
    libxslt1-dev \
    libzip-dev
RUN docker-php-ext-install -j$(nproc) \
	bcmath \
    gettext \
    intl \
    opcache \
    pcntl \
    posix \
    # soap \
    sockets \
    xsl \
    zip

### GD ###
RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd \
    && php -r "var_dump(gd_info());"

###
### Database ###
###
RUN apt install -y \
    libsqlite3-dev \
    libpq-dev
RUN docker-php-ext-install -j$(nproc) \
    dba \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pdo_sqlite \
    pgsql

#######################
### PECL extensions ###
#######################

FROM EXT AS PECL_EXT

### (http://pecl.php.net/packages.php)
### Use "pecl list-all" for all supported modules.
### Add extension=*** in php.ini for each pecl's extensions
RUN apt install -y \
    libmcrypt-dev
RUN pecl channel-update pecl.php.net \
    && echo "\n" | pecl install \
    apcu \
    ds \
    mcrypt \
    psr

###
### Database and search
###
RUN apt install -y \
    amqp-tools \
    cmake \
    libcurl4-openssl-dev \
    libmemcached-dev \
    librabbitmq-dev \
    libxml2-dev \
    zlib1g-dev
RUN pecl channel-update pecl.php.net \
    && echo "\n" | pecl install \
    couchbase \
    mongodb \
    solr
RUN echo "" | pecl install \
    amqp \
    memcached \
    redis

############################
### Coverage & Profiling ###
############################

FROM PECL_EXT AS FULL

### https://xdebug.org ###
RUN pecl install \
    pcov \
    xdebug \
    xhprof

### Apache bench ###
RUN apt install -y apache2-utils

#############
### Clean ###
#############
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*