FROM php:7.2-cli

# Update and import specific required librairies

RUN apt-get update && apt-get install -y apt-utils
RUN apt-get install -y \
	unzip \
	libicu-dev \
	gcc \
	wget \
	zlib1g-dev \
    libzip-dev

# Parametrize PHP

RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pcntl
RUN docker-php-source delete

# Install composer
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet
RUN mv composer.phar /usr/local/bin/composer
RUN mkdir /.composer && chmod o+rwx /.composer
