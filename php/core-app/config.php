<?php
/**
 * @author Tecksky Technology
 */

define("CONFIG",[
    "BASE_URL"=>"http://192.168.0.117/universetech/",
    "SERVER_URL" => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]",
    "SMTP_HOST" => "ssl://smtp.gmail.com",
    "SMTP_PORT" => "465",
    "SMTP_USER" => "dev11.ts11@gmail.com",
    "SMTP_PASS" => "tecksky@052820",
    "SMTP_SENDER" => "Universetech <dev11.ts11@gmail.com>",
    // "SMTP_SENDER" => "Universetech <info@universe.com>",
    "SMTP_RECIVER" => "Universetech <dev11.ts11@gmail.com>",
    // "SMTP_RECIVER" => "universetech <hr.tecksky@gmail.com>",//Default Reciver
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