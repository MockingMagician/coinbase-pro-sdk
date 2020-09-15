FROM php:7.3-cli
RUN apt-get update
RUN apt-get install -y libicu-dev
RUN apt-get install -y gcc
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
RUN docker-php-ext-enable mbstring
RUN docker-php-ext-enable intl
RUN docker-php-source delete
RUN apt-get install -y wget
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip
