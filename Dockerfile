FROM php:7.4-fpm-alpine

RUN apk add --no-cache --update make gcc g++ \
    libc-dev \
    autoconf

# - copy composer executable
COPY --from=composer /usr/bin/composer /usr/bin/

# - docker-php-ext-install
#RUN docker-php-ext-install mysqli \
#    && docker-php-ext-install pdo \
#    && docker-php-ext-install pdo_mysql

# - pecl install
RUN pecl install -o -f xdebug
#    && pecl install -o -f redis

# - enable extensions
RUN docker-php-ext-enable xdebug
#redis

# - php.ini files and configurations
ENV XDEBUG_INI_FILE=/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=10080" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.coverage_enable=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_enable=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_connect_back=1" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_log=/tmp/xdebug.log" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_autostart=true" >> ${XDEBUG_INI_FILE} \
    && echo "xdebug.remote_host=host.docker.internal" >> ${XDEBUG_INI_FILE}

# Please note that the Blackfire Probe is dependent on the session module.
# If it isn't present in your install, you will need to enable it yourself.