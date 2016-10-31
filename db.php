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
#stolen from the database code
    function db_connect(){
        global $config;
        try{
            return $conn = new PDO("mysql:host=".$config["db"]["host"].";dbname=".$config["db"]["dbname"].";", $config["db"]["username"], $config["db"]["password"]);
        } catch(PDOException $e){
            return null;
        }
    }



