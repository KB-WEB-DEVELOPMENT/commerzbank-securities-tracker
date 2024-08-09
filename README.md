# commerzbank-securities-tracker
Laravel Domain Driven Design (DDD) project which makes use of (German bank) Commerzbank 
Securities API.

To read about the Securities api:  https://developer.commerzbank.com/products/sandbox/securities-api/v4/try-this-api

Through the API, Commerzbank customers can retrieve information about: 

<b>(1) their account securities ids ( note: a customer may have only one account securities id or multiple account securities ids)</b>

<b>(2) the portfolio tied to each such account id</b>

<b>(3) all transactions tied to each such account id</b>

![alt text](https://github.com/KB-WEB-DEVELOPMENT/commerzbank-securities-tracker/public/images/commerzbank-securities-api-overview.png)

I followed Martin Joo's DDD's Laravel approach quite closely when it comes to structure:

![alt text](https://github.com/KB-WEB-DEVELOPMENT/commerzbank-securities-tracker/public/images/commerzbank-securities-api-structure.PNG)

Insights from his blog: https://martinjoo.dev/domain-driven-design-with-laravel-domains-and-applications

<b>A) Install and run:</b>

- cp .env.example .env
- composer install
- Set up your database

<p>You should request (1) an access token and (2) the live api access URI from Commerzbank for real data.</p>
<p></p>Those two values need to be set for the following two parameters in the .env file:</p>

<p>COMMERZBANK_ACCESS_TOKEN</p>
<p>COMMERZBANK_ACCESS_URI</p>
<p>(COMMERZBANK_URI_TIMEOUT=5)</p>

- php artisan migrate
- php artisan db:seed --class=DatabaseSeeder
- php artisan serve
- npm install
- npm run dev

You can login with username "demo@commerzbank.com" and password "password".

<b>B) Custom commands:</b>

<b>ImportPortfolioCommand.php</b> (File location: App/Console/Commands/ImportPortfolioCommand.php)

--> shows how the portfolio data for a specific account securities id would be imported

(Artisan command in terminal: php artisan portfolio:import)

<b>ImportTransactionsCommand.php</b> (File location: App/Console/Commands/ImportTransactionsCommand.php)

--> shows how  all transactions data for a specific account securities id would be imported

(Artisan command in terminal: php artisan transactions:import)

