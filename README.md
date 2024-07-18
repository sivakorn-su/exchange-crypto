1. Clone project
2. Create .env file by copy content from .env.example `cp .env.example .env` and get api key
   from [coingecko](https://www.coingecko.com/) and
   [exchangerate-api](https://www.exchangerate-api.com/) set your api key in .env or use default
3. Create Database named **Exchange** (MySQL 8), update `DB_USERNAME`, `DB_PASSWORD` in .env
4. Run `composer install`
5. Run `php artisan migrate:fresh --seed
6. use api endpoint 'api/register' to register a user
7. use api endpoint 'api/login' to login and get token
8. set token in header as 'Authorization' to access other api endpoints

