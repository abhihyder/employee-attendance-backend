
## Project setup
<h3>Please run those following command step by step</h3>


composer install

cp .env.example .env

php artisan key:generate

php artisan jwt:secret

<h3>Setup Database details and Mail server details (I have tested by mailtrap.io) in .env file. After that run those following command</h3>

php artisan migrate --seed

php artisan serve

## About Project
<p>This is a simple "Employee attendance management" project with API</p>

