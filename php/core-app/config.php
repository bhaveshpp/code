<?php
/**
 * @author Tecksky Technology
 */
define("CONFIG",[
    "BASE_URL"=>"http://192.168.0.117/universetech/",
    "SERVER_URL" => (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"
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