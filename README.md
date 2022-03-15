<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://hidevs.ir/assets/img/core-img/logo-text.png" width="400"></a></p>

# Laravel basic auth microservice
by [JalalLinuX](mailto:smjjalalzadeh93@gmail.com) at **[HiDevs Team](https://hidevs.team)**.

## Recommendation Packages
- #### Repository Pattern : [awes-io/repository](https://github.com/awes-io/repository)
- #### Persian sluggable : [pishran/laravel-persian-slug](https://github.com/pishran/laravel-persian-slug)

## Installation Steps

### 1. Clone from repository
```bash
git clone https://github.com/jalallinux/laravel-basic-auth-microservice example-service
```  
- Then go to project directory `cd example-service`

### 2. Install composer
```bash
composer install  
```  

### 3. Create environment
with `cp` command from example file
```bash
cp .env.example .env  
```  

### 4. Set important environment variables
```dotenv  
APP_NAME="Laravel-Basic-Auth-Microservice"
APP_ENV=production  
APP_DEBUG=false
APP_URL=

...  

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```  

### 5. Generate application key
```bash
php artisan key:generate  
```  

### 6. Migrate tables and seeding data
```bash
php artisan migrate  --seed
```  


<p align="center"><a href="https://hidevs.team">HiDevs Team</a></p>
