FROM alpine

RUN apk update
RUN apk add \
    composer \
    nginx \
    nodejs \
    openrc \
    php \
    php-curl \
    php-ctype \
    php-fpm \
    php-gd \
    php-mbstring \
    php-pdo \
    php-pdo_pgsql \
    php-pgsql \
    php-session \
    php-simplexml \
    php-tokenizer \
    php-xml \
    php-xmlreader \
    php-xmlrpc \
    php-xmlwriter \
    php-zip \
    php-zlib \
    postgresql \
    postgresql-contrib \
    yarn

EXPOSE 80 443


ADD nginx.conf /etc/nginx/nginx.conf

RUN adduser -D -u 1000 vizdev

RUN mkdir -p /home/vizdev/dbdata
RUN mkdir -p /var/run/postgresql

RUN chown -R nginx /var/log/nginx
RUN chown -R vizdev /home/vizdev
RUN chown -R postgres /home/vizdev/dbdata
RUN chown -R postgres:postgres /var/run/postgresql
RUN su -c 'initdb -D /home/vizdev/dbdata --locale en_US.UTF-8 -E UTF8' postgres

COPY vizdevdb.sql /docker-entrypoint-initdb.d/init.sql

ADD entrypoint.sh /home/vizdev/entrypoint.sh
ENTRYPOINT ["/home/vizdev/entrypoint.sh"]
