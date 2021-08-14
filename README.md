## About Project

<p>This is a simple "Employee attendance management" project with API.</p>

* An Employee can't check-in before 07:45 am.
* An Employee can't check-in or check-out twitch in a day.
* After check-in or check-out an employee, his/her manager will be notify by email.
* Every employee will get their daily work summary by email at 09:00 pm.


## Project setup
<h3>Please run those following command step by step</h3>

composer install

cp .env.example .env

php artisan key:generate

php artisan jwt:secret

<h3>Setup Database details and Mail server details (I have tested by mailtrap.io) in .env file. After that run those following command</h3>

php artisan migrate --seed

php artisan serve

php artisan run:scheduler


