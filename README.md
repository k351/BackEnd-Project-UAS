## About Us

Hi! We're a group of 6 people consisting of:

- Eryca Dhamma Shanty (535230071) | erycaaaaa 
- Enardo Stefanus (535230072) - etherealesz
- Georgia Sugisandhea (535230080)- furrypolo
- Alvin Kurniawan (535230084) - k351
- Christopher Wijaya (535230158) - bluw6525
- Brenda Abigail Han’s Hartama (535230194) - brendaabgl

In this project, we made an e-commerce website using Laravel.

 ## How to start?

- make sure you have installed postgres in your device
- make a new database with name of your "backend_project_uas"
- there's env example, change that to env and then change DB_DATABASE, DB_USERNAME, and DB_PASSWORD (and other variables if needed) according to your settings
- open database.php in app -> config -> database.php
- make sure this part is like this 'default' => env('DB_CONNECTION', 'pgsql')
- change variables in connection mysql and pgsql like the env example
- run "composer install" in your terminal after cloning this repository
- and then run "npm install"
- next run "npm run build"
- let's continue, run "php artisan migrate:fresh --seed"
- last but not least, run "php artisan serve"
- after that last code, it will puke out a link that you can run to try out our website.

 ## Okay! Happy surfing! Thankyou for trying out!

