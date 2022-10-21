FROM php:8.1-fpm

RUN apt-get update --fix-missing && apt-get install -y \
		cron \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get install -y --no-install-recommends \
    zip \
    wget \
    nano \
    unzip \
    curl \
    mc \
    libonig-dev libpq-dev \
    jpegoptim optipng pngquant gifsicle

RUN pecl install redis && docker-php-ext-enable redis

RUN docker-php-ext-install pcntl bcmath opcache ctype zip mbstring exif

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN mkdir -p /root/openvpn
WORKDIR /root/openvpn
RUN wget http://security.ubuntu.com/ubuntu/pool/main/p/protobuf/libprotobuf17_3.6.1.3-2ubuntu5_amd64.deb
RUN dpkg -i libprotobuf17_3.6.1.3-2ubuntu5_amd64.deb
RUN wget http://security.ubuntu.com/ubuntu/pool/main/libj/libjsoncpp/libjsoncpp1_1.7.4-3.1ubuntu2_amd64.deb
RUN dpkg -i libjsoncpp1_1.7.4-3.1ubuntu2_amd64.deb
RUN wget http://security.ubuntu.com/ubuntu/pool/universe/t/tinyxml2/libtinyxml2-6a_7.0.0+dfsg-1build1_amd64.deb
RUN dpkg -i libtinyxml2-6a_7.0.0+dfsg-1build1_amd64.deb
RUN apt-get install -y apt-transport-https
RUN wget https://swupdate.openvpn.net/repos/openvpn-repo-pkg-key.pub
RUN apt-get install -y gnupg
RUN apt-key add openvpn-repo-pkg-key.pub
RUN rm openvpn-repo-pkg-key.pub
RUN apt-get update
RUN apt-get install -y openvpn
RUN apt-get install -y systemd
RUN systemctl enable openvpn

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Changing Workdir
WORKDIR /application