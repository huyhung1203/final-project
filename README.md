Step to setup project
#Run command
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

- click follow the link in terminal
=> go to admin http://127.0.0.1:8000/admin
=> login account: aadmin@example.com, pass: passsword
