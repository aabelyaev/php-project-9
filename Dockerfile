FROM php:8.2-cli

RUN apt-get update \
    && apt-get install -y libzip-dev libpq-dev curl \
    && docker-php-ext-install zip pdo pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN useradd -u 1000 -ms /bin/bash appuser
USER appuser

WORKDIR /app

COPY --chown=appuser:appuser . .

RUN composer install --no-dev --optimize-autoloader

# Запускаем сервер PHP
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

EXPOSE 8000