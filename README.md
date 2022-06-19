# FWordsCleanerBot for Telegram

You need to have Docker and Docker Compose installed on your server to proceed using this PHP environment.

## Running the environment

- Copy .env.example to .env

```bash
cp .env.example .env
```

- Build and run the app with the following command:

```bash
docker-compose up -d --build
```

- Login in container:

```bash
docker exec -it php-app bash
```

- Install dependencies

```bash
composer install --optimize-autoloader --no-scripts && composer clear-cache
```

- Run loop command

```bash
php index.php
```

- Follow instruction (login as bot)

- Profit!
