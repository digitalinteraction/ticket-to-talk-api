This is an API for the Ticket to Talk application. The application handles creating accounts for people with dementia
that allows family and friends to add a collection of 'Tickets' (pictures, sounds, and YouTube videos), based on the
person with dementia's life. These tickets can then be used to help encourage and bridge gaps in conversation.

Getting Started

To use the application all endpoints except Login and Register require an API Key as a parameter. To get an API Key you
must first register and account and the key will be sent to you.

Setting the API on Your Own Stack

To install this on your own stack you first need to install php5-mycrypt for Laravel's bcrypt function to work. Following
on from this configure your `.env` file to point towards a MySQL schema that Laravel can use. If you intend to upload
media you need to set the `config/filesystems.php` file to point to an S3 bucket.
After this pull the project and run the following commands:

```

composer install
php artsian migrate:install
php artsian migrate
php artisan db:seed --class=InspirationTableSeeder
php artisan key:generate
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\JWTAuthServiceProvider"
php artisan jwt:generate

```
