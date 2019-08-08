<?php

if($_POST) {
    print_r($_POST);

    $to_Email       = "Your@email.here"; //Ypur email
    $subject        = "Заявка с лендинга";
    $host           = "xxxx.com"; // Your SMTP server. For example, smtp.mail.yahoo.com
    $username       = "xxxxx@xxxx.com"; //For example, your.email@yahoo.com
    $password       = "xxxxxxxxxxxxxxxxxxx";
    $SMTPSecure     = "ssl"; // For example, ssl
    $port           = 465; // For example, 465

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["initials"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_City        = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $user_Phone       = filter_var($_POST["tel"], FILTER_SANITIZE_STRING);
    $subject  = "Заявка с лендинга квартира под защитой";


    $messageBody = "<!DOCTYPE html><html lang='en' xmlns='http://www.w3.org/1999/xhtml'><head>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
    <title>Заявка с лендинга</title>
    <style type='text/css'>
        * { font-family: Segoe UI; }
        h1, h2 { font-family: Segoe UI Light; }
        .hidden { display: none; }
    </style>
</head>";

    $messageBody .= '<body>
    <h2>Контактная информация</h2>
    <table>
        <tr>
            <td>ФИО:</td>
            <td>
                <span>'. $user_Name .'</span></td></tr>';
    $messageBody .= '<tr><td>Мобильный телефон:</td><td><span crmfield="mobilephone">'. $user_Phone .'</span></td></tr>';
    $messageBody .= '<tr><td>E-mail:</td><td><span crmfield="emailaddress3">'. $user_Email .'</span></td></tr>';
    $messageBody .= '<tr><td>Телефон:</td><td><span crmfield="emailaddress3">'. $user_Phone .'</span></td></tr>';
    $messageBody .= '<tr><td>Город:</td><td><span crmfield="emailaddress3">'. $user_City .'</span></td></tr>';
    $messageBody .= '</body></html>';

    //proceed with PHP email.
    include("class/PHPMailerAutoload.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = $host;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = $SMTPSecure;
    $mail->Port = $port;
    $mail->CharSet  = 'utf-8';
    $mail->setLanguage('ru');

    $mail->setFrom($username);
    $mail->addReplyTo($user_Email);

    $mail->AddAddress($to_Email);
    $mail->Subject = $subject;
    $mail->Body = $messageBody;
    $mail->IsHTML(true);

    if(!$mail->send()) {

        $output = json_encode(array('type'=>'error', 'text' => 'Сообщение не может быть отправлено. Ошибка: ' . $mail->ErrorInfo));
        //die($output);

    } else {

        $output = json_encode(array('type'=>'message', 'text' => $user_Name .'! Спасибо за Ваше сообщение'));
        $mail2 = new PHPMailer();
        $mail2->IsSMTP();
        $mail2->SMTPAuth = true;
        $mail2->Host = $host;
        $mail2->Username = $username;
        $mail2->Password = $password;
        $mail2->SMTPSecure = $SMTPSecure;
        $mail2->Port = $port;
        $mail2->CharSet  = 'utf-8';
        $mail2->setLanguage('ru');
        $mail2->setFrom($username);
        $mail2->addReplyTo($user_Email); //to change
        $mail2->AddAddress($to_Email); //to change
        $mail2->Subject = $subject; //to change
        $mail2->Body = $messageBody; //to change
        $mail2->IsHTML(true);
        //die($output);
    }

    if(!$mailClient->send()){
        //$output = json_encode(array('type'=>'error', 'text' => 'Сообщение не может быть отправлено. Ошибка: ' . $mail->ErrorInfo));
        print_r($mail->ErrorInfo);
    } else {
        echo "\n Письмо отправлено клиенту";
    }
}
?>