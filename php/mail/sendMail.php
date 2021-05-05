<?php
// Pear Mail Library
require_once "Mail.php";
require_once "Mail/mime.php";

$from = "DEV !! <noreply@example.com>";
$to = 'TS !! <test@gmail.com>';
$subject = 'Hi!';
$body = "<html><body><h1>Hi,\n\nHow are you?</h1></body></html>";

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

$mime = new Mail_mime();
$mime->setHTMLBody($body);
$mime->addAttachment('Files/file.doc','doc');
$mime->addAttachment('Files/file.docx','docx');
$mime->addAttachment('Files/file.pdf','pdf');
$body = $mime->get();
$headers = $mime->headers($headers);

$smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'test@gmail.com',
        'password' => 'test@052820'
    ));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}