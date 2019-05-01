FROM php:7.2-fpm
RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install fileinfo mbstring pdo_mysql mysqli \
    && apt-get install -y zip unzip \
    && apt-get install -y vim curl

RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod 777 /usr/local/bin/composer

RUN cd /var/www && \
    curl https://get.fuelphp.com/oil | sh

WORKDIR /var/www
