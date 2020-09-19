FROM php:7.1-cli
RUN apt-get update
RUN apt-get install -y \
	apt-utils \
	libicu-dev \
	gcc \
	wget \
	zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-source delete
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/76a7060ccb93902cd7576b67264ad91c8a2700e2/web/installer -O - -q | php -- --quiet
RUN mv composer.phar /usr/local/bin/composer
