
# 🍀 Mercadona API 🍀

## Description ##
The Mercadona API is a RESTful API developed using PHP, employing Domain-Driven Design (DDD) and unit testing. This API interfaces with [Mercadona](https://tienda.mercadona.es/api/), offering an efficient way to access and manipulate product and category data.

## Setup ##

### Starting Docker Containers
Navigate to the `docker` directory:

```
cd docker
```

- Create a `.env` file in the docker directory as follows:
```
PROJECT_NAME="mercadona"
NGINX_PORT="8090"
PHP_PORT="80"
MYSQL_PORT="3306"
MYSQL_DATABASE="mercadona_local"
MYSQL_USER="root"
MYSQL_PASSWORD="root"
```

- Build the PHP image:
```
docker compose build --no-cache
```

- Launch and download images for MySQL and NGINX:
```
docker compose up -d
```

### Laravel Configuration
Run the following to install dependencies:
```
composer install
```
- Duplicate and rename `.env.example`.
- Update MySQL configuration to match Docker connection settings.

### Executing Migrations
Run migrations with the following command:
```
php artisan migrate
```

### Downloading Categories and Products

- Fetch and process products from the Mercadona API:
```
php artisan save-categories
```

## Endpoints

- Retrieve categories:
``` 
http://{host}:8090/api/categories
``` 

- Retrieve a specific category:
``` 
http://{host}:8090/api/categories/{categoryId}
``` 

- Retrieve products:
``` 
http://{host}:8090/api/products
``` 

- Retrieve a specific product:
``` 
http://{host}:8090/api/products/{productId}
```
