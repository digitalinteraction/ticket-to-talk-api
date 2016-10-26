# Dockerfile to deploy a silverstripe server

# Begin with a base Debian system (https://www.debian.org/), we are using the 'jessie' version
FROM debian:jessie

# Download the latest updates and
# install the packages we will need
RUN apt-get -y update \
 && apt-get -y upgrade -y \
 && DEBIAN_FRONTEND=noninteractive apt-get -y install \
        unzip zip \
        mysql-server \
        nginx-extras \
        php5-fpm \
        php5-mysql  \
        php5-mcrypt \
        php5-ldap \
        php5-gd \
        libssh2-php \
        php5-curl \
        curl \
        git \
        vim \
        php-pear && rm -rf /var/lib/apt/lists/*


# Configure PHP FPM (http://php-fpm.org/)
RUN sed -i "s/cgi.fix_pathinfo.\+/cgi.fix_pathinfo = 0/" /etc/php5/fpm/php.ini
RUN echo "clear_env = no" >> /etc/php5/fpm/php-fpm.conf
RUN sed -i 's/upload_max_filesize.\+/upload_max_filesize = 200M/' /etc/php5/fpm/php.ini
RUN sed -i 's/post_max_size.\+/post_max_size = 200M/' /etc/php5/fpm/php.ini


# Allow fastcgi
RUN sed -i 's/listen = .\+/listen = 127.0.0.1:9000/' /etc/php5/fpm/pool.d/www.conf

# Create the empty directories we will use
RUN mkdir -p /var/www/html
RUN mkdir -p /app && rm -fr /var/www/html && ln -s /app /var/www/html


# Install Composer, our PHP package manager (https://getcomposer.org/)
# Puts composer.phar in the root directory, \composer.phar
RUN curl -sS https://getcomposer.org/installer | php

RUN service mysql start

# Add our Composer configuration and install it's packages
WORKDIR /app
ADD . /app
#ADD composer.json /app/composer.json
#ADD composer.lock /app/composer.lock
RUN /composer.phar install
RUN chown -R www-data:www-data /app


# Set the timezone for php
RUN echo 'date.timezone="Europe/London"' >> /etc/php5/fpm/php.ini


# Add the cache folder and log file
RUN chown www-data:www-data -R bootstrap/
RUN chown www-data:www-data -R vendor/
RUN chown www-data:www-data -R storage/
RUN chmod -R 775 bootstrap/
RUN chmod -R 775 vendor/
RUN chmod -R 775 storage/


# Setup MySQL server
RUN ln -s /var/lib/mysql/mysql.sock /tmp/mysql.sock


# Add our nginx config file to nginx's config folder
ADD nginx-default /etc/nginx/sites-available/default


# Declare /data & /assets as a persistent volume
# (so they don't get removed when the server restarts)
VOLUME /data


# Declare the port we will use
EXPOSE 80


# Let our run script be run
RUN chmod +x /app/run.sh


# Start our application
CMD /app/run.sh