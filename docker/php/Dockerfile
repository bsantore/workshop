FROM php:7.2-fpm

# Provide sensible default values for enviroment variables. The file 
# docker/local.env overrides these values for local development.
ENV FPM_MAX_CHILDREN 5
ENV FPM_START_SERVERS 2
ENV FPM_MIN_SPARE_SERVERS 1
ENV FPM_MAX_SPARE_SERVERS 3
ENV PHP_DISPLAY_ERRORS Off
ENV PHP_HTML_ERRORS Off
ENV PHP_ERROR_REPORTING E_ALL & ~E_DEPRECATED & ~E_STRICT


# Prepare PHP files for a non-root user.
RUN mkdir /usr/local/src/app && \
  chown -R www-data:www-data /usr/local/src/app && \
  touch /var/log/php5-fpm.log && \
  chown www-data:www-data /var/log/php5-fpm.log && \
  touch /usr/local/etc/php/php.ini && \
  chown www-data:www-data /usr/local/etc/php/php.ini && \
  chown www-data:www-data /usr/local/etc/php-fpm.conf && \
  chown -R www-data:www-data /var/www

# Install dependencies. 
# - gettext provides the envsubst command used to process configuration files.
# - get, unzip, and zip are used by Composer.
# - wget is used to install Dumb Init.
RUN apt-get update && \
    apt-get -y install \
    gettext \
    git \
    unzip \
    wget \
    gnupg \
    apt-transport-https \
    zip && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Dumb Init.
RUN wget -O /usr/local/bin/dumb-init https://github.com/Yelp/dumb-init/releases/download/v1.2.1/dumb-init_1.2.1_amd64 && \
  chmod +x /usr/local/bin/dumb-init

# Install Composer.
RUN curl -sS https://getcomposer.org/installer | php -- \
  --filename=composer --install-dir=/usr/local/bin
   
# Trying to install mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli


# Copy PHP config file templates.
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini.template
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf.template

# Copy the entrypoint script. This script merges envrionment variables into the 
# config file templates to create the actual config files. 
COPY ./docker/php/entrypoint /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# Copy the application files.
COPY ./src /usr/local/src/app/src
COPY ./public /usr/local/src/app/public
COPY ./views /usr/local/src/app/views
COPY ./composer.json /usr/local/src/app/composer.json
COPY ./composer.lock /usr/local/src/app/composer.lock

# Set the workdir to the directory with the application files.
WORKDIR /usr/local/src/app

# Run as a non-root user.
USER www-data

# Install Composer dependencies.
RUN composer install --no-dev

# Run the entrypoint script when the container starts.
ENTRYPOINT ["entrypoint"]

# By default, start PHP-FPM.
CMD ["php-fpm"]

# Composer dump
RUN composer dump-
