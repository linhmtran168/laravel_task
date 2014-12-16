## Local Development Setup
* Change the file ```app/config/local/database.php``` to your local database setup and change the value __default__ in ```app/config/database.php``` to your local database type (MySQL or PostgreSQL)
* Run migration


    ```
    php artisan migrate
    ```
* Change the value __url__ in ```app/config/app.php``` to the url of that you will setup the application in local environment

