##############
# DOCKER PHP 
# https://hub.docker.com/_/php
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
    apt-utils \
    software-properties-common \
    gcc \
    cmake \
    make \
    autoconf \
    libc-dev \
    pkg-config

RUN apt install -y \
    bzip2 \
    git \
    gnupg \
    sqlite3 \
    wget \
    vim \
    zip

###
### Busybox and networks (https://busybox.net)
###
RUN apt install -y busybox netcat net-tools

###
### Language
###
#RUN apt install -y lua5.4 && lua -v
RUN php -v && perl -v

FROM CORE AS EXT

##################
# PHP extensions #
##################
# Available extensions:
# (Already installed: date, libxml, mysqlnd, openssl, sqlite3, zlib)
# ctype curl dom fileinfo filter ftp hash iconv json mbstring pcre pdo pdo_sqlite phar readline
# reflection session simplexml sodium spl standard tokenizer xml xmlreader xmlwriter
# 
# bcmath bz2 calendar dba dl_test enchant exif ffi gd gettext gmp imap intl ldap mysqli
# oci8 odbc opcache pcntl pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pgsql
# posix pspell shmop snmp soap sockets sysvmsg sysvsem sysvshm tidy xsl zend_test zip
##################
# RUN docker-php-ext-install -j$(nproc) \
	# bcmath \
    # gettext \
    # intl \
    # opcache \
    # pcntl \
    # posix \
    # soap \
    # sockets \
    # xsl \
    # zip \

### GD ###
RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd

###
### Database ###
###
# RUN docker-php-ext-install -j$(nproc) \
    # dba \
    # ldap \
    # odbc \
    # pdo_mysql \
    # pdo_odbc \
    # pdo_pgsql \
    # pgsql

#######################
### PECL extensions ###
#######################
### (http://pecl.php.net/packages.php)
### Use "pecl list-all" for all supported modules.
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
    libcurl4-openssl-dev \
    libmemcached-dev \
    librabbitmq-dev \
    libxml2-dev \
    zlib1g-dev
RUN pecl channel-update pecl.php.net \
    && echo "\n" | pecl install \
    couchbase \
    mongodb \
    redis \
    solr
RUN echo "" | pecl install \
    amqp \
    memcached

############################
### Coverage & Profiling ###
############################

FROM EXT AS FULL

# RUN apt-get install -y php7.4-pcov php7.4-phpdbg php7.4-xdebug

# XHPROF (tideways)
# RUN apt-get install -y graphviz php7.4-tideways

# Apache bench
# RUN apt-get install -y apache2-utils

#############
### Clean ###
#############
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*