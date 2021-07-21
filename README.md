#Laravel Base
####VanTu19000@gmail.com



###Laravel Passport

composer require laravel/passport

php artisan migrate

php artisan passport:install

https://laravel.com/docs/8.x/passport


###Create Event

php artisan make:event PodcastProcessed

php artisan make:listener SendPodcastNotification --event=PodcastProcessed

