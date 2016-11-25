<?php

/**
 * Created by PhpStorm.
 * User: zera
 * Date: 10/28/16
 * Time: 2:21 AM
 */
include_once "../db.php";
include_once "comapi.php";
include_once "../config.php";
require_once('../Database.php');
#TODO: change the way purpose is defined for this entire class
class user_verification
{
    #creates token for authentication and sends email
    #
    function send_ver_email(string $user_name, int $purpose){

        $db = Database::getInstance();
        $sql = "SELECT users.id, email, user_name, user_verified, name
              FROM users inner join userinformation on users.id = userid WHERE users.user_name = ?;";
        $db->query($sql, array($user_name));
        $result =$db->getResults();
        if(empty($result)){
            return;
        }
        $user = $result[0];
        $token = $this->generate_token($db, $user[id], $purpose);
        if(empty($token)){
            return;
        }
        $mail = new comapi();
        #TODO: create template and add link to correct url instead of the token
        switch ($purpose){
            case 1:
                $message = "Hello ".$user[name]." you have created a user named ".$user[user_name]. " The token is $token";
                break;
            case 2:
                $message = "Hello ".$user[user_name]." You have requested to have your password reset The token is $token if you have not requested this just ignore the email";
                break;
            case 3:
                $message = "Hello ".$user[user_name]." The token for login is $token";
                break;
        }

        #TODO: check if valid token allready exists and invalidate it?

        $mail->SendEmailv2($user["email"], "confirmation email", $message);

    }
    function verify(string $token, int $purpose){
        global $config;
        $db = Database::getInstance();
        $sql = "SELECT * from user_token WHERE token = ? and created + INTERVAL ? HOUR > NOW() and invalidated is NULL and purpose = ?;";
        $db->query($sql, array(hash("sha256", $token), $config["token"]["expiration"], $purpose));
        $conn = db_connect();


        $stmt = $conn->prepare(
            "SELECT * from user_token WHERE token = ? and created + INTERVAL ? HOUR > NOW() and invalidated is NULL and purpose = ?;");
        $stmt->execute(11111111);
        $result =$stmt->fetchAll();
        if(empty($result)){
            return false;
        }
        $userid = $result[0]["id"];
        #TODO: is this safe? data comes from db so should be safe but consider it
        if($purpose == 1){
            $result = $conn->exec("UPDATE users SET user_verified = 1 WHERE id = $userid; UPDATE user_token SET invalidated = NOW()");
        } else{
            $result = $conn->exec("UPDATE user_token SET invalidated = NOW()");
        }
        return empty($result);

    }
    function update_password(string $token){

    }
    #posibly problematic
    private function generate_token( Database $conn, int $userid, int $purpose) : string{
        $token = bin2hex(random_bytes(32));
        $sql = "INSERT INTO user_token
                                (token, created, userid, purpose)
                                VALUES(?, NOW(), ?, ?);";
        $conn->query($sql, array(hash("sha256", $token), $userid, $purpose));
        if(!$conn->getCount()) {
            return;
        }
        return $token;
    }

}