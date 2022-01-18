FROM php:7.4

WORKDIR /usr/apps/edeans

RUN apt-get -y update \
    && apt-get install -y git zip \
    && apt-get install -y sqlite3 libsqlite3-dev

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
