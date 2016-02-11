#requirement
-php 5.5+
-apache open rewrite module
-mysql

#install guide
-open cmd in project folder
-use command "php composer.phar install"
-import db with file sql/gis.sql
-config db with file config/medoo

#Start server example
php -S localhost:8080 -t public

#test localhost:8080/person
