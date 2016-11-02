define({
  "name": "Ticket to Talk API",
  "version": "1.0.0",
  "description": "Documentation for the Ticket to Talk API",
  "title": "Ticket to Talk API",
  "url": "http://52.35.119.74/api",
  "header": {
    "title": "About",
    "content": "<p>This is an API for the Ticket to Talk application. The application handles creating accounts for people with dementia\nthat allows family and friends to add a collection of 'Tickets' (pictures, sounds, and YouTube videos), based on the\nperson with dementia's life. These tickets can then be used to help encourage and bridge gaps in conversation.</p>\n<p>Getting Started</p>\n<p>To use the application all endpoints except Login and Register require an API Key as a parameter. To get an API Key you\nmust first register and account and the key will be sent to you.</p>\n<p>Setting the API on Your Own Stack</p>\n<p>To install this on your own stack you first need to install php5-mycrypt for Laravel's bcrypt function to work. Following\non from this configure your <code>.env</code> file to point towards a MySQL schema that Laravel can use. If you intend to upload\nmedia you need to set the <code>config/filesystems.php</code> file to point to an S3 bucket.\nAfter this pull the project and run the following commands:</p>\n<pre><code>\ncomposer install\nphp artsian migrate:install\nphp artsian migrate\nphp artisan db:seed --class=InspirationTableSeeder\nphp artisan key:generate\nphp artisan vendor:publish --provider=&quot;Tymon\\JWTAuth\\Providers\\JWTAuthServiceProvider&quot;\nphp artisan jwt:generate\n\n</code></pre>\n"
  },
  "sampleUrl": false,
  "apidoc": "0.2.0",
  "generator": {
    "name": "apidoc",
    "time": "2016-10-26T07:58:56.749Z",
    "url": "http://apidocjs.com",
    "version": "0.16.1"
  }
});
