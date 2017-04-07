#!/bin/bash
docker-compose stop && docker-compose rm -f
rm -Rf tmp
docker run --rm -v $(pwd):/var -w /var composer/composer create-project --prefer-dist laravel/laravel tmp
docker run --rm -v $(pwd):/var -w /var bash -c 'mv /var/tmp/* /var'
docker run --rm -v $(pwd):/var -w /var bash -c 'mv /var/tmp/.[^.]* /var/'
docker run --rm -v $(pwd):/var -w /var bash -c 'rm -Rf /var/tmp'
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan optimize
docker-compose up -d