Package ParserRssAtom
================

[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/prusmarcin/laravelshelterapi/blob/master/LICENSE)


- [Installation](#installation)
- [Testing](#testing)
- [Credits](#credits)
- [License](#license)


Installation
------------

Clone repository to your catalog on server.

Then run `composer update` in your terminal to pull it in.

``` bash
$ composer update
```

And configure the database connection in `.env` file for your Laravel installation.

Run migration

``` bash
$ php artisan migrate
```
Note: If you have error when you run migration: "Specified key was too long error solution". Read this article: [https://geektnt.com/laravel-5-4-migration-unique-key-is-too-long.html](https://geektnt.com/laravel-5-4-migration-unique-key-is-too-long.html)

Run laravel server
``` bash
$ php artisan serve
```
And you're done!

Testing
-------

Then run the tests with:

``` bash
$ vendor/bin/phpunit
```


Credits
-------

- [Prus Marcin](https://github.com/prusmarcin)
- [My portfolio](https://prusmarcin.pl)


License
-------

The MIT License (MIT). Please see [License File](https://github.com/prusmarcin/laravelshelterapi/blob/master/LICENSE) for more information.
