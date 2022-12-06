# 🍀 Mercadona API 🍀 #

## Description ##
 - **API Rest make with PHP, DDD and unit test, thats API works with [Mercadona](https://tienda.mercadona.es/api/).**


## SET UP ##

### Go to docker folder and up the docker containers
```
cd docker
```
- Build php imange  
 ```
     docker compose build --no-cache
 ```

- Up and download images: mysql nginx 
 ```
     docker compose up -d
 ```
### Execute Migrations
```
php artisan migrate
```

### Download Categories and products

- Download main categories from mercadona API
```
php artisan save-categories
```

- Download and process products from mercadona API
```
php artisan save-categories
```

# EndPoints

- Get categories
``` 
http://{hos†}:8090/api/categories
``` 

- Get category
``` 
http://{hos†}:8090/api/categories/{categoryId}
``` 

- Get products
``` 
http://{hos†}:8090/api/products
``` 

- Get product
``` 
http://{hos†}:8090/api/products/{productId}
``` 