FROM alpine

RUN apk update
RUN apk add \
    composer \
    nginx \
    openrc \
    php \
    php-curl \
    php-fpm \
    php-mbstring \
    php-pdo \
    php-pdo_pgsql \
    php-pgsql \
    php-session \
    php-tokenizer \
    php-xml \
    php-xmlreader \
    php-xmlrpc \
    php-xmlwriter \
    php-zlib \
    postgresql \
    postgresql-contrib

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

ADD entrypoint.sh /home/vizdev/entrypoint.sh
ENTRYPOINT ["/home/vizdev/entrypoint.sh"]
