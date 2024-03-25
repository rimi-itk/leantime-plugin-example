# Leantime plugin example

## Controllers

* `/example/tickets`

## Commands

```shell
bin/leantime example:test
```

## Assets

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 yarn install
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 npx mix
```

## Coding standards

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer install
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer coding-standards-check

docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer coding-standards-apply
```

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 yarn install
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 yarn coding-standards-check
```

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 yarn coding-standards-apply
```

## Release

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest composer install --no-dev
docker run --tty --interactive --rm --volume ${PWD}:/app itkdev/php8.1-fpm:latest bin/create-release test


```
