FROM php:7.4

WORKDIR /usr/apps/edeans

RUN apt-get update && apt-get install -y git zip

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
