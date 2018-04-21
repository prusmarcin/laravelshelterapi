Laravel Shelter API Server
================

[![License](http://img.shields.io/badge/license-MIT-lightgrey.svg)](https://github.com/prusmarcin/laravelshelterapi/blob/master/LICENSE)


- [Installation](#installation)
- [Testing](#testing)
- [Documentation API](#documentation)
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

Documentation
-----

You need to run seeder then api will be return data.

``` bash
$ php artisan migrate:refresh --seed
```

All available methods by API:
![Screenshot](dostepne-metody.jpg)


Call method `GET`: `http://localhost:8000/api/shelters` for returns all shelters.

Returns:

``` json
[
    {
        "name": "Schronisko Gdańsk",
        "city": "Gdańsk",
        "size": 1300
    },
    {
        "name": "Schronisko Gdynia",
        "city": "Gdynia",
        "size": 2200
    }
]
```

Call method `POST`: `http://localhost:8000/api/shelters` for create new shelter.

Must send body as JSON(application/json)
{
	"uskey":"a9d5m",
	"name":"Schronisko Testowe",
	"city":"Bydgoszcz",
	"size":100
}

Returns if is correct validation

``` json
{
    "uskey": "a9d5m",
    "name": "Schronisko Testowe",
    "city": "Bydgoszcz",
    "size": 100,
    "updated_at": "2018-04-21 18:56:35",
    "created_at": "2018-04-21 18:56:35",
    "id": 3
}
````

Returns if is incorrect validation

``` json
{
    "error": true,
    "msg": "The uskey must be at least 5 characters. "
}
````
OR
``` json
{
    "error": true,
    "msg": "The uskey has already been taken. "
}
````

Call method `GET`: `http://localhost:8000/api/shelters/1` for returns selected shelter.

Returns:

``` json
{
    "name": "Schronisko Gdynia",
    "city": "Gdynia"
}
````

Call method `PUT` or `PATCH`: `http://localhost:8000/api/shelters/1` for update selected selter.

Must send body as JSON(application/json)
{
	"uskey":"a9d5m",
	"name":"Schronisko Testowe",
	"city":"Bydgoszcz",
	"size":100
}

Returns if is correct validation

``` json
{
    "msg": "Shelter updated.",
    "updated": true
}
````

Call method `DELETE`: `http://localhost:8000/api/shelters/1` for remove selected shelter.

Returns if shelter exists

``` json
{
    "msg": "The shelter was removed",
    "deleted": 1
}
```

Returns if shelter does not exist

``` json
{
    "error": true,
    "message": "There is no such shelter to be removed"
}
```

Credits
-------

- [Prus Marcin](https://github.com/prusmarcin)
- [My portfolio](https://prusmarcin.pl)


License
-------

The MIT License (MIT). Please see [License File](https://github.com/prusmarcin/laravelshelterapi/blob/master/LICENSE) for more information.
