# Instructions 

## Introduction

this repo is for task purpose 

## Development Setup
make sure Your system have [Composer](https://getcomposer.org/download/)
and [Symfony Cli](https://symfony.com/download) installed

### Initial setup

Clone the repository to your local machine.

```shell
git clone https://github.com/Cadu007007/LocalBrandTask.git
cd LocalBrandTask
```
set next .env values

set database

    DATABASE_URL=

setup username and password for basic auth

    EMPLOYEE_USERNAME=
    EMPLOYEE_PASSWORD=
    
```php
composer install 

symfony console doctrine:database:create 

symfony console doctrine:migrations:migrate 

symfony serve -d

symfony console messenger:consume -vv async 
```

i assumed that the request like the postman collection that in the project direction

```shell
Local Brand Task.postman_collection.json
```

set up your environment variable for postman

#### code can be enhanced more than this