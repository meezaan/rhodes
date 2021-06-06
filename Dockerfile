FROM islamicnetwork/php:8.0-apache-dev

COPY . /var/www/html/

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
