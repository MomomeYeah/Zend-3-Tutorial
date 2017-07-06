# Zend Tutorial

## Introduction

This project uses the [Zend 3 Tutorial](https://docs.zendframework.com/tutorials/getting-started/overview/)
as a baseline for a bit of experimenting on how best to use it in an actual project.

## Setup

This project includes a `Vagrantfile` based on ubuntu 16.04 (bento box)
with configured Apache2 and PHP 7.0. Start it up using:

```bash
$ vagrant up
```

Once built, you can also run composer within the box. For example, the following
will install dependencies:

```bash
$ vagrant ssh -c 'composer install'
```

While this will update them:

```bash
$ vagrant ssh -c 'composer update'
```

While running, Vagrant maps your host port 8080 to port 80 on the virtual
machine; you can visit the site at http://localhost:8080/
