FROM php:7.4-cli
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
CMD [ "php", "./index.php" ]

# FROM php:7.2-apache
# COPY /usr/src/myapp /var/www/html/

FROM php:7.4-apache

# pdo_mysql package
RUN docker-php-ext-install pdo_mysql