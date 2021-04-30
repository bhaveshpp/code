<?php
require('config.php');
require('request-helper.php');

if (isset($_POST['SUBMIT'])) {   
    $request = new Request();
    if (isset($_POST['SUBMIT']['GET_IN_TOUCH'])) {
        print_r(json_encode($request->submitGetInTouch($_POST['SUBMIT']['GET_IN_TOUCH'])));
    }
    if (isset($_POST['SUBMIT']['NEWSLETTER'])) {
        print_r(json_encode($request->submitNewsletter($_POST['SUBMIT']['NEWSLETTER'])));
    }
    if (isset($_POST['SUBMIT']['APPLY_FOR_JOB'])) {
        print_r(json_encode($request->applyForJob($_POST['SUBMIT']['APPLY_FOR_JOB'])));
    }
}else{
    header('Location: '.getBaseUrl());
}