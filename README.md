SetUp Project:-

  <p><b>Step 1.</b>  Clone Repository git clone https://github.com/binaryprotagonist/laravel-task.git <p>
  <p> <b>Step 2.</b>  cd laravel-task<p>
  <p> <b>Step 3.</b>  composer update<p>
  <p> <b>Step 4.</b>  Create database named as laravel_task<p>
  <p> <b>Step 5.</b>  Copy .env-example file with named as .env and update database credentials in .env file<p>
  <p> <b>Step 6.</b>  Update email credentials in .env file<p>
 <p> <b>Step 7.</b>  php artisan migrate<p>
 <p> <b>Step 8.</b>  php artisan db:seed<p>
 <p><b>Step 9.</b>  php artisan serve<p>
  <p><b>Step 10.</b>  php artisan queue:work<p>
