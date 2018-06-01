# Ticket to Talk - API
> Visit **[ticket-to-talk.com](http://ticket-to-talk.com)** for information on the project.

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Installation
1. Clone the repository from git:
```bash
git clone https://github.com/digitalinteraction/ticket-to-talk-api.git
```

2. Install Laravel
```bash
composer.phar install
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan key:generate
php artisan migrate
php artisan db:seed --class=InspirationTableSeeder
```

3. In the root of the project create a `.env` file with the following variables:
```bash
APP_ENV=local
APP_DEBUG=true
APP_KEY=changethistosomethingsupersecret
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticket_to_talk
DB_USERNAME=root
DB_PASSWORD=secret
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync
MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

## Starting the API
Run:
```bash
docker-compose up --build
```

This will create a container for the API, and a container for a basic MySQL database. If you want to use an external database update the database information in the `.env` file and run: `docker start` instead.

## Misc
### Generating API docs
Run:
```bash
apidoc -i app/Http/Controllers/ -o public/docs/
```

This will generate API docs using comments from the routes in the Controllers folder. Navigate to `http://localhost:8080/docs`
