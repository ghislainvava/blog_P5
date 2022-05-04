<?php
    require 'vendor/autoload.php';
    use \Mailjet\Resources;
    $mj = new \Mailjet\Client('71ac9495c066ed098c9690059b311983','4d471ac41e3c84d68b63120b59422e27',true,['version' => 'v3.1']);
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST["message"])) {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars(($_POST['message']));
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){       
            $body = [
                'Messages' => [
                [
                    'From' => [
                    'Email' => "ghisshop@icloud.com",
                    'Name' => "ghislain"
                    ],
                    'To' => [
                    [
                        'Email' => "ghisshop@icloud.com",
                        'Name' => "ghislain"
                    ]
                    ],
                    'Subject' => "Greetings from Mailjet.",
                    'TextPart' => "$email, $message",
                    // 'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
                    // 'CustomID' => "AppGettingStartedTest"
                ]
                ]
            ];
            $response = $mj->post(Resources::$Email, ['body' => $body]);
            $response->success() && var_dump($response->getData());
            echo "Email réussi"
        }else{
            echo "Email non valide";
        }
    }else{
        header('location:index.php');
        die();
    }