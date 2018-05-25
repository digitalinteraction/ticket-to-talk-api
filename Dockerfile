# From Rob's Debain-PHP-ssmtp dockerfile
FROM openlab.ncl.ac.uk:4567/rob/composer-image:1.1.0


# Set timezone
RUN echo 'date.timezone="Europe/London"' >> /etc/php5/fpm/php.ini


# Copy nginx file
COPY nginx-default /etc/nginx/sites-available/default


# Copy composer files
COPY ["composer.json", "composer.lock", "/app/"]


# Copy database directory
COPY database /app/database


# Copy tests directory
COPY tests /app/tests


# Run composer
RUN /composer.phar install


# Run bootstrap.sh
COPY bootstrap.sh /app/


# Add the rest of the project files
ADD . /app


# Set folder permissions
RUN chown www-data:www-data -R bootstrap/
RUN chown www-data:www-data -R vendor/
RUN chown www-data:www-data -R storage/
RUN chmod -R 775 bootstrap/
RUN chmod -R 775 vendor/
RUN chmod -R 775 storage/


# Expose the port
EXPOSE 80
