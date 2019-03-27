FROM alpine

RUN apk update
RUN apk add \
    php \
    php-curl \
    php-fpm \
    php-mbstring \
    php-session \
    php-tokenizer \
    php-xml \
    php-xmlreader \
    php-xmlrpc \
    php-xmlwriter \
    php-zlib \
    composer \
    nginx \
    openrc

RUN chown -R nginx /var/log/nginx
EXPOSE 80 443

ADD entrypoint.sh /home/vizdev/entrypoint.sh
ENTRYPOINT ["/home/vizdev/entrypoint.sh"]

RUN mkdir -p /home/vizdev/
RUN adduser -D -u 1000 vizdev
RUN chown -R vizdev /home/vizdev

ADD nginx.conf /etc/nginx/nginx.conf
