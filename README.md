# P5-blog
Blog project built with PHP
## Installation
This project uses composer and docker.

1. Clone the repository.
2. Run `composer install` to install the dependencies.
3. Edit docker-composer.yml and config/dbConfig.yml.example to fit your configuration and rename dbConfig.yml.example to dbConfig.yml. Same process with mailerConfig.yml.example.
4. Run `docker compose up -d` to launch the mysql container.
5. Import the database and its sample from dumps/db_dump.sql using your favourite IDE or with the docker command </br> `docker exec <container_name> mysql -u root -password=PASSWORD < db_dump.sql`
6. Run php's built-in web server from the public folder with `php -S localhost:8000`
7. The homepage is available on : `localhost:8000`

## Third party libraries

- [Twig](https://twig.symfony.com/) as template engine
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) to send mails
- [bramus/router](https://github.com/bramus/router) for route handling

## Code quality

[SymfonyInsight](https://insight.symfony.com/projects/6b21070a-d713-49e4-be5b-2a7c600e4583)
