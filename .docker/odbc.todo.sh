#!/bin/bash

########
# ODBC #
########
# /etc/odbc.ini not needed
# config in /etc/odbcinst.ini
# WORKDIR /tmp
# RUN apt-get install -y odbcinst1debian2 libodbc1
# RUN wget https://dev.mysql.com/get/Downloads/Connector-ODBC/8.0/mysql-connector-odbc_8.0.21-1ubuntu20.04_amd64.deb
# RUN md5sum mysql-connector-odbc_8.0.21-1ubuntu20.04_amd64.deb
# RUN test "$(md5sum mysql-connector-odbc_8.0.21-1ubuntu20.04_amd64.deb)" = "62e280b8d8e5d3531c6de2b57c37b1a5  mysql-connector-odbc_8.0.21-1ubuntu20.04_amd64.deb"
# RUN dpkg -i mysql-connector-odbc_8.0.21-1ubuntu20.04_amd64.deb 
# RUN apt-get install -y php7.4-odbc
