# Web Liturgi RK

## About

Web untuk keperluan liturgi di Greja RK.

Menggunakan Bahasa pemrograman PHP dengan laravel framework.

## Requirement

- PHP 7.4.
- Web Server (eg: Apache, Nginx)
- Database MySQL
- Redis
- Composer
- Node version 14+ or LATEST (recommended)

## Installation

### Preparation

1. Clone Repository

```
$ git clone https://github.com/biyanoscar/liturgi-rk-web-2020.git
```

2. Copy .env in project root and setting your environment

```
$ cp .env.example .env
```

3. Install dependencies

```
$ composer install
```

4. Generate laravel application key

```
$ php artisan key:generate
```

5. Install Node Module

```
// with npm
$ npm install

// with yarn
$ yarn install
```

6. Copy the vendor theme template folder, the following directory

```
/public/vendor
/public/fonts
```
## How to commit

Don't forget to fetch and rebase from branch <b>Master</b> first before push.

**Fetch all remotes**

```
$ git fetch --all
```

**Rebase Master**

```
$ git rebase <master branch>
```

**Add new file or change file**

```
$ git add <file name>
```

**Add all new file**

```
$ git add .
```

**Confirm file addition or change**

```
$ git commit -m "<commit message>"
```

**Post changes to the repository**

```
$ git push origin <branch name>
```
