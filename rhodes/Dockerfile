FROM islamicnetwork/php:8.0-apache-dev

COPY . /var/www/
RUN cd /var/www && composer install --no-dev
RUN chown -R www-data:www-data /var/www/