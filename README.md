Rent Car System
============================

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

You can get this project using the following command:
~~~
git clone https://github.com/hendrignwn/rentcarsystem.git
~~~
Notes: You can install git bash in your computer using https://www.atlassian.com/git/tutorials/install-git

You can then install module this project in directory using the following command:
~~~
composer install
~~~
Notes: You can install composer in your computer using https://getcomposer.org/doc/00-intro.md

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=rentcar',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
RUNNING
--------

Import database using following command:
~~~
php yii migrate
~~~

You can running using:
http://localhost/rentcarsystem/web