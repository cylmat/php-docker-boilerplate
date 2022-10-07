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

RUN apt update && apt install -y curl git zip
WORKDIR /var/www/application

FROM CORE AS SIMPLE

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

##################
# PHP extensions #
##################

FROM CORE AS EXT

RUN apt update

##################
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
    sockets \
    xsl \
    zip

### GD ###

RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && php -r "var_dump(gd_info());"

### PECL extensions ###

RUN pecl channel-update pecl.php.net

### (http://pecl.php.net/packages.php)
### Use "pecl list-all" for all supported modules.
### Add extension=*** in php.ini for each pecl's extensions
RUN apt install -y libmcrypt-dev
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install \
    apcu \
    ds \
    mcrypt \
    psr

#####################
### DB extensions ###
#####################

FROM EXT AS DB_EXT

RUN apt update

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

RUN apt install -y \
    amqp-tools \
    libcurl4-openssl-dev \
    libmemcached-dev \
    librabbitmq-dev
RUN echo "" | pecl install \
    amqp \
    memcached \
    redis

### PECL extensions ###

RUN pecl channel-update pecl.php.net

# RUN pecl install couchbase
# RUN pecl install mongodb
# RUN pecl install solr

############################
### Coverage & Profiling ###
############################

FROM DB_EXT AS FULL

RUN apt update

### Busybox (https://busybox.net)
### and network tools (ifconfig ping netstat nslookup...)

RUN apt install -y busybox dnsutils iputils-ping netcat net-tools nmap tcpdump telnet

### Languages ###

# RUN apt install -y lua5.4

### @see https://xdebug.org ###

RUN pecl install \
    pcov \
    xdebug \
    xhprof

### Apache bench

RUN apt install -y apache2-utils

### Ssh ###

# Use following to send an ssh key on remote host
# ssh-copy-id -i ~/.ssh/id_ed25519.pub user@remote-host.com
RUN rm -f ~/.ssh/id_ed25519*
RUN apt install -y ssh && \
    ssh-keygen -t ed25519 -C "your_email@example.com" -f ~/.ssh/id_ed25519 -N "" && \
    eval "$(ssh-agent -s)" && \
    ssh-add ~/.ssh/id_ed25519

#############
### Clean ###
#############
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
