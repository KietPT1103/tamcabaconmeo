FROM php:8.3-apache
RUN apt-get update && apt-get install -y git unzip libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql zip intl \
    && a2enmod rewrite && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel
WORKDIR /var/www/html
COPY app/ .
COPY docker/entrypoint.sh /usr/local/bin/start-app
RUN sed -i 's/\r$//' /usr/local/bin/start-app && chmod +x /usr/local/bin/start-app
ENTRYPOINT ["start-app"]
