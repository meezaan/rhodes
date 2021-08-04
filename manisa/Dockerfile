FROM quay.io/islamic-network/php:8.0-apache-dev

COPY . /var/www/
RUN cd /var/www && composer update --no-dev
RUN chown -R www-data:www-data /var/www/
