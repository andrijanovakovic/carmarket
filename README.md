# CarMarket
(this is school-project I used to learn about Twig & PHP)\
A car market web-app for selling second-hand and new vehicles (currently only cars).

# Specs
* [PHP (7.3.2)](http://www.php.net/)
* [Twig](http://www.slimframework.com) - php micro framework
* [Slim](http://www.slimframework.com/docs/v3/features/templates.html) - view engine
* [Eloquent db ORM](https://laravel.com/docs/5.8/eloquent) - laravel's orm
* [MySQL 5.7](https://dev.mysql.com/downloads/mysql/5.7.html) - db
* [Bootstrap v4.3](https://getbootstrap.com/docs/4.3/getting-started/introduction/) - html, css, js


## Installation
```
git clone https://github.com/andrijanovakovic/carmarket.git
cd carmarket
composer install
composer dump-autoload
```
Before you visit the page on your localhost, you should import db schema through MySQL workbench, HeidiSQL or something else...\
db schema is located in:
```
./db_backup/main_schema.sql
```

## Note about PHPMailer
This app uses PHPMailer which uses Google's Gmail API to send e-mails. You should specify your own username (email) and password for that to work in:
```
./app/config/test.php
```

## App config
App mode is defined in:
```
./mode.php
```
This means that if the content of ./mode.php is "development", app will search for `development.php` in:
```
./app/config/
```
