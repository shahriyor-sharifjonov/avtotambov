<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    // от кого письмо
    $mail->setFrom('help@avtotambov.ru', 'avtotambov');
    // кому отправить
    $mail->addAddress('avtotambov68.ru@yandex.ru');
    // тема письмо
    $mail->Subject = 'Обратная связь c сайта avtotambov.ru';

    // VIN-CODE
    $vin_code = $_POST['vin'];




    // тело письмо
    $body = '<h1>Письмо с сайта avtotambov</h1>';

    if(trim(!empty($_POST['vin']))){
        $body.='<p><strong>VIN CODE:</strong> '.$_POST['vin'].'</p>';
    }
    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }
    if(trim(!empty($_POST['marka']))){
        $body.='<p><strong>Марка автомобиля:</strong> '.$_POST['marka'].'</p>';
    }
    if(trim(!empty($_POST['phone']))){
        $body.='<p><strong>Номер телефона:</strong> '.$_POST['phone'].'</p>';
    }
    if(trim(!empty($_POST['comment']))){
        $body.='<p><strong>Комменарий к звонку:</strong> '.$_POST['comment'].'</p>';
    }

    $mail->Body = $body;

    // Отправляем
    if (!$mail->send()){
        $message = 'Ошибка';
    } else {
        $message = 'Данные отправлены!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>