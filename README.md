# Pirates Test

## Installation guidlines

1. import `piratestest.sql` in your mysql server.
2. set `config\config.php` (siteurl and database connections).
3. run `composer install`.
4. visit your root directory, it should be running

**Tips**

1. For testing the functionality , replace **your email** with moizsattar@yahoo.com email in `users` table, to become a moderator.
2. if you dont want to change email after creating job post visit `logs/pirates.log` you can find both emails in there too


## design patterns

1. Front controller design pattern
2. Singleton design pattern

## standards

1. PSR-2 for coding
2. PSR-4 for autoloading
3. DRY approach

## libraries used

1. Eloquent ORM
2. Encryptor for encryption of links
3. Blade Templating engine
4. GUMP for validating requests
5. PHP Mailer for Emails
6. MONOLOG for logging
7. Events and Listeners for listening the job post creations events to send email accordingly

**Happy Coding**