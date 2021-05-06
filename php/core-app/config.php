<?php
/**
 * @author Tecksky Technology
 */

define("CONFIG",[
    "BASE_URL"=>"http://192.168.0.117/universetech/",
    "SERVER_URL" => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]",
    "SMTP_HOST" => "ssl://smtp.gmail.com",
    "SMTP_PORT" => "465",
    "SMTP_USER" => "email@gmail.com",
    "SMTP_PASS" => "secure",
    "SMTP_SENDER" => "Universetech <info@example.com>",
    "SMTP_RECIVER" => "Universetech <testing@gmail.com>",
]);

function getBaseUrl()
{
    return CONFIG['BASE_URL'];
}

function getUrl($path = '')
{
    return CONFIG['BASE_URL'].$path;
}

?>