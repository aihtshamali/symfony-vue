## Symfony-Task
- This is a Symfony 6 project that provides a basic structure for building web applications. It uses Model-View-Controller (MVC) architecture pattern and includes various built-in features.


## Installation

In order to setup the project, please the below guidelines:

- Clone the repository on your local machine
- Install Composer if you haven't already done so.
   a- check composer by running the command `composer -v`
- Afterwards, run `composer install` to install the project dependencies.
- Set up your .env file by setting up the following variables:
   a- Set username and password in `DATABASE_URL`
   b- Set `MAILER_DSN` by getting your SMTP URL from mailtrap.io and use test mail sending and choosing the integrations of Symfony5+
- Run `php bin/console doctrine:database:create` to create the database.
- Run `php bin/console doctrine:migrations:migrate` to run the database migrations.
- Run `symfony local:server:start` or `php bin/console server:run` to run the local server
- Navigate to `http://localhost:8000` in your web browser to view the application.
- Run the following command in the CLI in order to fetch all the fruits from the URL and save them to the database:
    `php bin/console fruits:fetch`

- After the command has been executed successfully, check your inbox over mailtrap. You will be receiving an email of success.

## Usage:

This project allows us to fetch all the fruits from fruity vice and and save in the database which will further on can be get via `fruits/all` API and use as per need.


## For Vue Project `fruity_mania_app`

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

### Project Usage
 This project shows all the fruits and allow a user to add those fruits to favorites (maximum 10) and also shows the nutrition facts of all those favorite fruits along with its total.