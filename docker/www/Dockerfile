FROM php:8.1-apache
# Poniższy zapis oznacza pobranie najnowszej wersji composera z dockerhub i zapisanie go '/usr/local/bin/composer'.
COPY --from=library/composer:2.5 /usr/bin/composer /usr/local/bin/composer
# Poniższy zapis oznacza wskazanie apache w którym folderze znajduje się aplikacja.
ENV APACHE_DOCUMENT_ROOT /www

RUN apt-get update -y \
    && apt-get upgrade -y

# add git
RUN apt-get install -y git

# add mySql
RUN docker-php-ext-install pdo pdo_mysql

# add PHP intl extension
RUN apt-get install -y zlib1g-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# add zip
RUN apt-get install -y libzip-dev zip \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# add OPCache
RUN docker-php-ext-install opcache

# add GD
RUN apt-get install -y libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd

# clean
RUN apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/*


# config apache server
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite

# add php config
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1"
COPY conf.d/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY conf.d/realpath.ini /usr/local/etc/php/conf.d/realpath.ini
COPY conf.d/post_max_size.ini /usr/local/etc/php/conf.d/post_max_size.ini
COPY conf.d/upload_max_filesize.ini /usr/local/etc/php/conf.d/upload_max_filesize.ini
COPY conf.d/memory_limit.ini /usr/local/etc/php/conf.d/memory_limit.ini


RUN mkdir -m777 /www
WORKDIR /www
