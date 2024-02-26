# ITK

Routes

* `/itk/timesheets`
* `/itk/todos`

``` shell
docker run --rm --volume ${PWD}:/app --env COMPOSER=composer.dev.json itkdev/php8.1-fpm:latest composer install
docker run --rm --volume ${PWD}:/app --env COMPOSER=composer.dev.json itkdev/php8.1-fpm:latest composer coding-standards-check
```
