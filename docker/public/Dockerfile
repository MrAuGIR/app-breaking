﻿FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN usermod -u 1000 www-data \
        && usermod -G staff www-data \
        && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
        && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

CMD ["apache2-foreground"]
