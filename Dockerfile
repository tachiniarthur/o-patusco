# Usar uma imagem base do PHP com Composer e Node.js instalados
FROM php:7.4-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip \
    && docker-php-source delete

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Laravel
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run production

# Ajustar permissões
RUN chown -R www-data:www-data /var/www

# Expor a porta do PHP-FPM
EXPOSE 9000

# Comando de inicialização
CMD ["php-fpm"]
