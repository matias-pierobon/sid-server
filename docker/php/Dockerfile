FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    autoconf \
    make \
    openssl \
    git \
    unzip

RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

RUN ln -snf /usr/share/zoneinfo/America/Argentina/Buenos_Aires /etc/localtime && echo "America/Argentina/Buenos_Aires" > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', "America/Argentina/Buenos_Aires" > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

RUN docker-php-ext-install pdo pdo_mysql

RUN pecl install ds
RUN docker-php-ext-enable ds

# RUN pecl install xdebug
# RUN docker-php-ext-enable xdebug
# RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

ADD / /abipon

RUN echo 'alias sf="php /abipon/bin/console"' >> ~/.bashrc

RUN chmod -R 777 /abipon/var/cache
RUN chmod -R 777 /abipon/var/logs
RUN chmod -R 777 /abipon/var/sessions

WORKDIR /abipon

# RUN composer install

EXPOSE 9000