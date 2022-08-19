
![Logo](https://laravel.com/img/logomark.min.svg)

## Enfemeras
This project is oriented to the administration of "Nurses afilation" through of the a company, also register many mounthly pay and bonyfications.


## Features

- user management (administrator and asistant)
- Create user authentication (administrator and asistant)
- Block system users
- Manage Nurses(Afiliados)
- Register Acreditations(mountly pay)
- Manage Packages(Bonus)
- Show enrollment report
- Show borrowers report
- Show yes it has gift(canaston) report
- Show yes it hasn't gift(canaston) report



## Requirements
- PHP 7 o 8
- Composer
- Apache 
- Mysql or Maria db
## Deployment

- To deploy this project run this command:

```bash
  composer install
```

- Config the file .env to seting the database:
- run this command
```bash
  php artisan migrate
```
- install passport to create personal access token
```bash
  php artisan passport:install
```
- run the project
```bash
  php artisan serve
```



## Documentation

[Laravel 8 documentation](https://laravel.com/docs/8.x/installation)

