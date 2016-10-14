#!/bin/bash

## copy env vars into www pool
echo -e "\n; Automatically added by /run.sh" >> /etc/php5/fpm/pool.d/www.conf
env | sed -E 's/^([^=]+)=/env[\1] = /' >> /etc/php5/fpm/pool.d/www.conf

service nginx start
# service apache2 start
service php5-fpm start

tail -F /var/log/nginx/access.log /var/log/nginx/error.log
# tail -F /var/log/apache2/access.log /var/log/apache2/error.log