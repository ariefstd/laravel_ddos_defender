
<h1>Step Configuration CMS Laravel</h1>
<br><br>

## Setting .env

Set `.env` database (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

## Setting composer.json

"require-dev": {
        "graham-campbell/analyzer": "^3.0",
        "graham-campbell/testbench": "^5.6",
        "mockery/mockery": "^1.3.1",
        "phpunit/phpunit": "^8.5.8 || ^9.3.7"
    },
    "autoload": {
        "psr-4": {
            "GrahamCampbell\\Throttle\\": "src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "GrahamCampbell\\Tests\\Throttle\\": "tests/"
        }
    },
    "config": {
        "preferred-install": "dist"
    },
    "extra": {
        "laravel": {
            "providers": [
                "GrahamCampbell\\Throttle\\ThrottleServiceProvider"
            ]
        }
    },
    "minimum-stability": "dev",
    "prefer-stable": true

## Add throttle.php file to folder config

`throttle.php`

## Add src folder to folder app

`link github : https://github.com/GrahamCampbell/Laravel-Throttle`

## Please read the article about how to prevent DDoS attack using Laravel and throttle

`link https://fbutube.com/content/ddos-prevention-methods-laravel-throttle-to-avoid-ddos-attack`

## Open PHP Folder and Open php.ini file

`php.ini -> active extension: exif & gd2`

## Open Terminal or Command Prompt, type:

`php artisan db:seed --class=UserTable`

Then:
`composer install`

Then:
`composer update`

Then:
`php artisan storage:link`

Finally:
`php artisan serve`

