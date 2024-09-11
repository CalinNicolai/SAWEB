# Используем базовый образ PHP
FROM php:8.1-cli

# Устанавливаем зависимости и Composer
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo pdo_mysql mysqli \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Команда по умолчанию
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
