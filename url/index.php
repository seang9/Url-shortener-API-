<?php
require 'Slim/Slim.php';
require 'shortner.php';
require 'cards.php';
require 'database.php';
use Slim\Slim;
\Slim\Slim::registerAutoloader();

$app = new Slim();
$app->get('/findall', 'getUrls');//Get all urls
$app->get('/findall/:query', 'geturlbyid'); //Get a specific url
$app->get('/findall/statistics/', 'getstaturls');//Get all statistics
$app->get('/findall/stat/:query', 'getstatbyid'); //Get the statistics for a specific url code
$app->delete('/findall/deleteurl/:query','deleteurl');//Remove url
$app->put('/findall/updateurl/:query', 'updateurl'); //Update url
$app->post('/findall/add', 'addurl'); //Add or insert new url
$app->get('/findall/popular/', 'getpopularurl'); //find most popular short code
$app->get('/findall/counturls/', 'getNumofurls'); //Total number of urls
$app->get('/findall/topbrowser/', 'getopbrowser'); //Most used browser
$app->run();
?>



