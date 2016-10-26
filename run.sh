#!/bin/bash

## copy env vars into www pool
echo -e "\n; Automatically added by /run.sh" >> /etc/php5/fpm/pool.d/www.conf
env | sed -E 's/^([^=]+)=/env[\1] = /' >> /etc/php5/fpm/pool.d/www.conf

service mysql start
service nginx start
service php5-fpm start

mysql -u root --password=  < create-db.sql
php artisan migrate:install
php artisan migrate
php artisan db:seed --class=InspirationTableSeeder

tail -F /var/log/nginx/access.log /var/log/nginx/error.log