FROM php:7.1-apache

# install the PHP extensions
RUN apt-get update \
 && apt-get install -y \
      libjpeg-dev \
	  libpng-dev \
	  zip \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
 && docker-php-ext-install gd mysqli opcache

# set recommended PHP.ini settings
# see https://secure.php.net/manual/en/opcache.installation.php
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=2'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN a2enmod rewrite expires

# install Composer
RUN curl -s -f -L -o /tmp/installer.php https://getcomposer.org/installer \
 && php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer \
 && composer --ansi --version --no-interaction \
 && rm -rf /tmp/*

# copy source files
COPY code /var/www/html

# install dependencies using Composer
RUN composer install --working-dir=/var/www/html

# make only uploads directory modificable from PHP
RUN chown -R root:root /var/www/html \
 && chown -R www-data:www-data /var/www/html/content/uploads

VOLUME /var/www/html/content/uploads

CMD ["apache2-foreground"]
