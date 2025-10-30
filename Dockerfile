FROM php:8.1.16-apache

# Instala a extensão mysqli
RUN docker-php-ext-install mysqli

# Instala Xdebug apenas se não estiver presente
RUN if ! php -m | grep -q xdebug; then \
        pecl install xdebug || true; \
    fi && docker-php-ext-enable xdebug

# Copia o arquivo de configuração do Xdebug
COPY xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini
