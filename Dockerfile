FROM webdevops/php-nginx

WORKDIR /app
ADD composer.json /app/composer.json
ADD composer.lock /app/composer.lock
RUN /composer install

ADD . /app

RUN artisan migrate

EXPOSE 80
CMD ["supervisord"]
