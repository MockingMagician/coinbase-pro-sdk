FROM php:7.4-cli

# Update and import specific required librairies

RUN apt-get update && apt-get install -y apt-utils
RUN apt-get install -y \
	unzip \
	libicu-dev \
    libonig-dev \
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
COPY composer.sh /
RUN chmod +x composer.sh
RUN /composer.sh
RUN mv composer.phar /usr/local/bin/composer
RUN mkdir /.composer && chmod o+rwx /.composer
