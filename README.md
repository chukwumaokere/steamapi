# steamapi
A search that uses Steam's API to return data about games.  
A fun way to view Steam's Library of games, videos, add-ons, and apps. 

## This is all the source code for http://chukwumaokere.com/steamapi/
Use this site to check out the rotating background: http://chukwumaokere.com/steamapi/index2.php  
I use this site when building the app using electron: http://chukwumaokere.com/steamapi/indexforapp.php  

### Create a file in the same directory named "db.php" with these contents:
```php
<?php

$servername = 'localhost';
$dbusername   = '';
$dbpassword   = '';
$dbname     = 'steamapi_db'; //the db you want to use for the mini steam library

$link = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

$db = new mysqli($servername, $dbusername, $dbpassword, $dbname);
```
### Use testimport2.php script to import the steamgames2.json file to a the mini steam library database

## TODO:
Finish pagination  
Finish styling modal  
Finish fixing rotating background  
