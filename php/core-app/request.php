<?php
require('config.php');
require('code/Tecksky/Helper/Request.php');

if (isset($_POST['SUBMIT'])) {   
    $request = new Request();
    if (isset($_POST['SUBMIT']['NEWSLETTER'])) {
        print_r(json_encode($request->submitNewsletter($_POST['SUBMIT']['NEWSLETTER'])));
    }
    if (isset($_POST['SUBMIT']['CONTACT'])) {
        print_r(json_encode($request->submitContact($_POST['SUBMIT']['CONTACT'])));
    }
    if (isset($_POST['SUBMIT']['CAREER'])) { // it is career service
        print_r(json_encode($request->applyForJob($_POST['SUBMIT']['CAREER'])));
    }
}else{
    header('Location: '.getBaseUrl());
}