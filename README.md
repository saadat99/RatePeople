# SlebVote

SlebVote is a website where you can rate celebrities.

# Prerequisites
* PHP 7.2 <br/>
* Mysql Server 8.x without "caching_sha2_password"

# Installation 

* Set your MySQL database credentials in `config_example.php` and rename it to `config.php`
* Import `Dump.sql` file into your mysql server. Schema name should be `slebvote`
* `php -S localhost:8000` to run php's built-in web server

Then visit http://localhost:8000
