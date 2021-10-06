# RP-System-V2

Follow the below steps to set up the project.

1. Install Composer Dependencies using the command, 'composer install'
   
2. Install NPM Dependencies using the command, 'npm install'

3. Generate an app encryption key using the command, 'php artisan key:generate'. Check the .env file to see if a long random string of characters appears in the APP_KEY field.

4. Create an empty database for the application.

5. In the .env file, add database information to allow Laravel to connect to the database. In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created. 

6. Fill in MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS in the .env file using the credentials of the sender to send email using the system.

7. Fill in MAIL_USERNAME, MAIL_PASSWORD, MAIL_FROM_ADDRESS in the config/mail.php file using the above details.

7. Migrate the database using the command, 'php artisan migrate'

8. Use the command, 'php artisan serve' to run the application.
