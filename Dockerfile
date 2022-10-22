FROM ubuntu:18.04

#UPDATING OS
RUN apt-get update
RUN apt-get install software-properties-common -y
# UPGRADE PHP7.4 REPOSITORY
RUN apt-add-repository ppa:ondrej/php -y
RUN apt-get update

#PHP ENVIROMENTS
ENV TZ=America/Mexico_city
ENV PHP_VR=8.1

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
ARG DEBIAN_FRONTEND=noninteractive
# LINUX DEPENDENCIES
RUN apt-get update
RUN apt-get install apache2 php${PHP_VR} zip unzip curl nano -y

# PHP DEPENDENCIES
RUN apt-get install php${PHP_VR}-mysql php${PHP_VR}-gmp php${PHP_VR}-zip php${PHP_VR}-curl php${PHP_VR}-gd php${PHP_VR}-bcmath php${PHP_VR}-mbstring php${PHP_VR}-xml php${PHP_VR}-soap php${PHP_VR}-imagick php${PHP_VR}-redis php${PHP_VR}-cli -y

# APACHE CONFIGURATION
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Apache Mod Rewrite active and config
RUN a2enmod rewrite
RUN sed -ri -e 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# WORKSPACHE DIRECTORY
WORKDIR /var/www/html

# INTEGRATING COMPOSER
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

COPY ./ ./

EXPOSE 8080
CMD apachectl -D FOREGROUND
