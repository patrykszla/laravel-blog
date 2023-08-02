# blog project in progress using laravel



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# How to run project?

1. install dependencies
composer install
npm install

2. create .env file 
cp .env.example .env
php artisan key:generate

3. build CSS and JS assets
npm run dev

4. To run all of migrations
php artisan migrate

5. To run artisan serve

php artisan serve

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
