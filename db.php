<?php
/**
 * Created by PhpStorm.
 * User: zera
 * Date: 10/17/16
 * Time: 11:44 PM
 * Status - In progress
 * Purpose centrilise db connection
 */
include 'config.php';
phpinfo();
//$conn = new mysqli($servername, $username, $password, $dbname);
print_r($config["db"]["dbname"]);