FROM quay.io/islamic-network/php:7.4-apache-dev

COPY . /var/www/
RUN cd /var/www && composer update --no-dev
RUN chown -R www-data:www-data /var/www/
