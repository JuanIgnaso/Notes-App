FROM php:8.2-apache

#Copiar virtual host por defecto de Apache en el contenedor
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

#Habilitar rewrite mode
RUN a2enmod rewrite

#Instalar paquetes necesarios
RUN apt-get update && \ 
    apt-get install \ 
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

#Instalar extensiones de PHP
RUN docker-php-ext-install zip pdo_mysql

#Copiar instalable de Composer
COPY ./install-composer.sh ./

#Copiar el archivo php.ini(archivo de configuración de PHP) a el container
COPY ./php.ini /usr/local/etc/php/

#Limpiar los paquetes y instalar Composer, luego eliminarlo porque una vez esté instalado
#no lo necesitaremos más
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

#Cambiar WORKDIR
WORKDIR /var/www

#Cambiar el propietario del root del container
RUN chown -R www-data:www-data /var/www

#Arrancar Apache en segundo plano
CMD [ "apache2-foreground" ]