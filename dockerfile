FROM php:8.1-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
&& docker-php-ext-install dom zip pdo_mysql mbstring bcmath \
&& apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod -R 777 /usr/bin/composer

RUN useradd -G www-data,root -u $uid -d /home/$user $user \
&& mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www
ADD . /var/www
RUN chown -R www-data:www-data /var/www

USER $user
ENV COMPOSE_PROJECT_NAME=finance-app

# USER root
