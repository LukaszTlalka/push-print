FROM php:8.1-apache

MAINTAINER Lukasz Tlalka

RUN apt update
RUN apt install -y cron vim curl zip git 
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        graphviz \
        optipng \
        iputils-ping

# extensions
RUN docker-php-ext-install bcmath mbstring zip exif

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# vim configuration
ADD ./.docker/vim/.vimrc /root/

ARG VIM_STOCK=false

RUN if [ ${VIM_STOCK} = true ]; then \
    rm /root/.vimrc \
;fi

# Cron entry for www-data

RUN echo "* * * * * www-data bash -l -c '/usr/local/bin/php /var/www/artisan schedule:run >> /var/www/storage/logs/cron-log 2>&1'" >> /etc/crontab

WORKDIR /var/www
