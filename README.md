# Leantime plugin example

## Installation

Download a release from
<https://github.com/rimi-itk/leantime-plugin-example/releases> and extract into
your Leantime `Plugins` folder, e.g.

``` shell
curl --silent --location https://github.com/rimi-itk/leantime-plugin-example/releases/download/0.0.0/leantime-plugin-Example-0.0.0.tar.gz | tar xv
```

Install and enable the plugin:

``` shell
bin/leantime plugin:install leantime/example --no-interaction
bin/leantime plugin:enable leantime/example --no-interaction
```

## Controllers

* `/example/tickets`

## Commands

```shell
bin/leantime example:test
```

## Development

```shell
git clone https://github.com/rimi-itk/leantime-plugin-example app/Plugins/Example
```

### Assets

```shell
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 yarn install
docker run --tty --interactive --rm --volume ${PWD}:/app --workdir /app node:20 npx mix
```

### Coding standards

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
# https://github.com/catthehacker/docker_images/pkgs/container/ubuntu#images-available
# Note: The ghcr.io/catthehacker/ubuntu:full-latest image is HUGE!
docker run --rm --volume ${PWD}:/app --workdir /app ghcr.io/catthehacker/ubuntu:full-latest bin/create-release test
# Show release content
tar tvf leantime-plugin-*-test.tar.gz
```
