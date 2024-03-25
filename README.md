# Leantime plugin example

## Controllers

* `/example/tickets`

## Commands

```shell
bin/leantime example:test
```

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer install
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer coding-standards-check

docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer coding-standards-apply
```

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app node:20 yarn --cwd /app install
docker run --tty --interactive --rm --volume ${PWD}:/app node:20 yarn --cwd /app coding-standards-check
```

## Release

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer install --no-dev
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest bin/create-release test


```
