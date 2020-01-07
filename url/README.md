# Url-shortener API 
This is a url shortner app which converts URLs into short codes.The short code can be used and redirected to the original url.
The application has persistent storage which keeps track of the successful urls. Url-shortener app also keeps statistics of each url 
such as the user ip address, the date url was added, the date url was last accessed, the host address of the url. The 
application also keeps track of how many clicks url has received.
I have incorporated restful api using slim framework which carries out CRUD operations.The user can edit the url or delete the url asynchronously.
Application also contains data cards which are appended from the data in the database and are asynchronously updated once crud operation is carried out. 
I had issues in relation to docker images. Please check screenshoot in images folder.

## Installation
1\. Download and extract the files to your web directory.

2\. Create a MySQL database named `shortdb` and import the `link.sql` file. This will create a table to hold your URLs.

3\. Configure your webserver `.htaccess`

3\. Edit `database.php`and enter your database credentials.

4\. Edit `urlapi.php`and enter your Apache port number in the base url.

5\. Edit `main.js`and enter your Apache port number in the root url.

6\. Run http://localhost:4006/url/urlapi.php to vist the home page

## Database
Import the `link.sql` file
```
CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `url` tinytext NOT NULL,
  `short_code` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL,
  `added_date` timestamp NULL DEFAULT current_timestamp(),
  `user_ip` text NOT NULL,
  `browser` text NOT NULL,
  `referer` text DEFAULT NULL,
  `lastused` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```
## htaccess
Apache configuration (.htaccess) file must be  included in order for the shortcode  to be redirected.
`.htaccess` 
```htaccess
RewriteEngine On
RewriteRule ^findall(.*)$ index.php [QSA,L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ urlapi.php?redirect=$1 [L]
```
## Database credentials
Edit the `database.php` file.
Edit the username , password and host to your sql credentials
```
$dsn = 'mysql:host=localhost:3307;dbname=shortdb;charset=utf8';
$username = '**root**';
$password = '****';
```
## urlapi.php baseurl
Edit the port number depending on what port Apache using.(Line 5)
```
$base_url='http://localhost:4006/url/'; 
``` 
## main.js rooturl
Edit the port number depending on what port Apache using.(Line 2)
```
var rooturl = "http://localhost:4006/url/findall/";
``` 
## Project Architecture
In order to have RESTful API i used the Slim Framework which is a great micro framework for Web application.
Crud operation are caried out in  `shortner.php` and their updated asynchronously in the `main.js` to the frontend.
The main functionality of the  url shortener is in  `urlapi.php`.
Data cards functionality is carried out in `cards.php` and their updated asynchronously in the `main.js` to the frontend.
`index.php` contains Slim applications resource URI.

## URL Paths for API

Request Method | URI | Body (JSON) | Description |  
:---: | :--- | :---: | :--- |
GET | http://localhost:`4006`/url/findall | - | Get all urls | 
GET | http://localhost:`4006`/url/findall/:id | - | Get a specific url | 
GET | http://localhost:`4006`/url/findall/statistics/ | - | Get all statistics and urls| 
GET | http://localhost:`4006`/url/findall/stat/:id | - | Get all statistics for specific url |
DELETE | http://localhost:`4006`/url/findall/deleteurl/:id | - | Remove a specific url |
PUT | http://localhost:`4006`/findall/updateurl/:id | "id":"","url":"","short_code":"".. | Update url |
POST | http://localhost:`4006`/findall/add|"url": ""| Add url |
GET | http://localhost:`4006`/url/findall/popular/| - | Find the most popular short code | 
GET | http://localhost:`4006`/url/findall/counturls/ | - | Total number of urls in the database | 
GET | http://localhost:`4006`/url/findall/topbrowser/ | - | Most used browser | 
GET | http://localhost:`4006`/url/:short_code | - | Short code redirects to the long url |  
GET | http://localhost:`4006`/url/urlapi.php?url= | - | Enter long url to revive the shortcode |
## Example of short urls
Long url | Short url |
:---: | :--- |
https://www.westmeathindependent.ie/ |http://localhost:4006/url/d43783
https://timetable.ait.ie/login.aspx?ReturnUrl=%2fdefault.aspx | http://localhost:4006/url/36a88f
https://www.imdb.com/movies-coming-soon/ | http://localhost:4006/url/5ca43a