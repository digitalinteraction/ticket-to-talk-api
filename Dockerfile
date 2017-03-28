FROM openlab.ncl.ac.uk:4567/b30282237/composer-image:1.0.4


COPY nginx-default /etc/nginx/sites-available/default


COPY ["composer.json", "composer.lock", "/app/"]

COPY database /app/database
COPY tests /app/tests

RUN /composer.phar install


COPY bootstrap.sh /app/


ADD . /app


RUN chown www-data:www-data -R bootstrap/
RUN chown www-data:www-data -R vendor/
RUN chown www-data:www-data -R storage/
RUN chmod -R 775 bootstrap/
RUN chmod -R 775 vendor/
RUN chmod -R 775 storage/

EXPOSE 80

