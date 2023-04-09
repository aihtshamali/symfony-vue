## Symfony Task
- This is a Symfony 6 project that provides a basic structure for building web applications. It uses Model-View-Controller (MVC) architecture pattern and includes various built-in features.


## Installation

In order to setup the project, please the below guidelines:

1- Clone the repository on your local machine
2- Install Composer if you haven't already done so.
    a- check composer by running the command `composer -v`
3- Afterwards, run `composer install` to install the project dependencies.
4- Set up your .env file by setting up the following variables:
    a- Set username and password in `DATABASE_URL`
    b- Set `MAILER_DSN` by getting your SMTP URL from mailtrap.io and use test mail sending and choosing the integrations of Symfony5+

5- Run `php bin/console doctrine:database:create` to create the database.
6- Run `php bin/console doctrine:migrations:migrate` to run the database migrations.
7- Run `symfony local:server:start` or `php bin/console server:run` to run the local server
8- Navigate to `http://localhost:8000` in your web browser to view the application.
9- Run the following command in the CLI in order to fetch all the fruits from the URL and save them to the database:
    `php bin/console fruits:fetch`

10- After the command has been executed successfully, check your inbox over mailtrap. You will be receiving an email of success.

## Usage:

This project allows us to fetch all the fruits from fruity vice and and save in the database which will further on can be get via `fruits/all` API and use as per need.