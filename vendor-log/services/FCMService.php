<?php

namespace App\Services;
use GuzzleHttp\Client;

class FCMService
{


     // Public property to store the service account key
     public $serviceAccountKey = [
            "type"=> "service_account",
            "project_id"=> "astromatch-be7e5",
            "private_key_id"=> "10ebc042a52637fe920e84ea6a3b51066bebed95",
            "private_key"=> "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDdbg7M5RtJxi0H\nydpLab7doxrOj4xk7fd8zk2ZWK07rpe2jEIlEX0p8af343RqK5JITaMh7IMqDk+u\nkSFLtxlO0wokIFwJcFW+e7NhU7pLr8TQl4F7fb5BeYwq4j5XYC/BJ3inL9y++Vif\nZ3XnQmnseJjMx2dVswp93GHqdGd9rZUw2n3iwWlMNNXUPw+QzWRZGIvfTy7cnNig\nngIz/bpcLxeikAQHog1qCk7ge2Vbnfv/yYOozHdCpapA6PBMMxE2O3gXlDMY6KzZ\nRSzV7/RKGBodMrtVoEtXlh90ZYgV6OH4f3wTF4yLis1EZUy0HurQ0ErXbBOWpjGG\nyU91weXVAgMBAAECggEADB3q6Orrlpql2ayByckoVOQJQj7oMZi1B4sZg3fvCNpJ\nuodL0k/1767l4GJ9uxaVy2eWMvPIjKtaUGToM8a5946EWkw8BRc01fbabsvAYMZm\nSHzV7M5JdDdExI77VtgwXMs+ZrWviHLIFvb4JHbFqZdC00fhH3cr7o25/PSwOhgE\nyECka3r9b6DY4k+efeOj5k658tMNLf+R3b+HiwZu5DXuTDiJvG99k0ckOcd6ZgFs\nzo8kKRNnduxD8edkX6xoZm+i0GWFqM0LmmJQ3Kouodf0TNS6jGm+GMUEUcXWgg2n\niHbihYhPjLocdCN+Tj8U+O5fXtmvsDHIkrYZ1BcnCQKBgQDwXmIYFoaf2Q7d4B31\nlFLvUVaZkhjoZWJVtEzrJ68vEg07H3gNM5i0vK2w/y5Ppe9daC5NAizuFTGQ77zl\nyPcb1u1EIGlIpssiU/nXp4AKU6PZJg/3X55m+ly1rdVW8q2jKdVYTcKKxSd4u1Eu\n7eFFxA/fvAnk1bAjFzymSVweOQKBgQDr1GKdAR0UUqqUs3kmTKIE0ZqhpvWQyl9x\nwB6sHH6ppzGVQqDBoaQovd8kRAKi/0YFHkaE0YUsrTI4m1VjXOYdQFKFjgfznQUw\nMIgm6IN80KsH0fXtXwuwUxRk9FOslfONUijLGaqE0KNQF4LD3gUFk9tBRyxkaDuw\no0pOicBEfQKBgQCwVLznaNb3upbyY2/28QlqMKQz4n5NNdrOfocS1zjncfmszqgW\nHyy+Ic/VkU2a9mLDhiK5MYheW8PRzF0pwKSukpvaJ2C1AE7ybuJQtrryWGtRaF+8\nHDQq3S1Xxh9EOqDwmka9EcZOYNVU9y1WHQHuWSc//UTQz4X4KBrA7f4a2QKBgHL+\npHt0sI5ZZQ6PmXLAiXyaDLHorPPGitX33b0FRApMGdRzodnpjRfExktz0mlS2vzh\n73cSh8LqTYPm0rNZ+GepFtRDFsOG/KGr+KgoVv2E7vEoQ6hU4WlAicBUl3yfvhxa\nRMQMpuaOqiQC4uPJnl9C4vYo04++d+TBKxmy+AstAoGBAJpm4L+xEl1EohPgHkkF\n0tyBR7Z+tHOU/9m3QY8ASP7Fyrh1RP7Ub0I2m5EVyl9QsWmly5cQ7j4nnBL4eaGo\nNJPF8olrlwawnurBbw/14d3k7zmQPida5rYP9p+ifwVyKsvk6tQTGB220gkqWgrI\nx0zMfwOLaPqDkHvhIVvoXMkW\n-----END PRIVATE KEY-----\n",
            "client_email"=> "firebase-adminsdk-1ta6r@astromatch-be7e5.iam.gserviceaccount.com",
            "client_id"=> "112452887809238568850",
            "auth_uri"=> "https://accounts.google.com/o/oauth2/auth",
            "token_uri"=> "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url"=> "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url"=> "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-1ta6r%40astromatch-be7e5.iam.gserviceaccount.com",
            "universe_domain"=> "googleapis.com"
    ];


public static function send($userDeviceDetail, $notification)
{
    $fcmService = new self();
    $projectId = 'astromatch-be7e5';
    $serverApiKey = env('FCM_SERVER_KEY');
    $accessToken = $fcmService->getAccessToken($serverApiKey);
    $endpoint = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

    $responses = []; // Array to store individual responses

    foreach ($userDeviceDetail->pluck('fcmToken')->all() as $token) {
        $notificationType = isset($notification['body']['notificationType']) ? (string) $notification['body']['notificationType'] : null;


        // $payload = [
        //     'message' => [
        //         'token' => $token,
        //         'notification' => [
        //             'title' => $notification['title'],
        //             'body' => $notification['body']['description'],
        //         ],
        //         'data' => [
        //             'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        //             'body' => json_encode($notification['body']),

        //         ],
        //         'android' => [
        //             'priority' => 'high',
        //         ],
        //     ],
        // ];

        $payload = [
            'message' => [
                'token' => $token,
                // 'notification' => [
                //     'title' => $notification['title'],
                //     'body' => $notification['body']['description'],
                // ],
                'data' => [
                    'title' => $notification['title'],
                    'description' => $notification['body']['description'],
                    'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                    'body' => json_encode($notification['body']),
                ],
                'android' => [
                    'priority' => 'high',
                ],
            ],
        ];


        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
        ];

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $responses[] = json_decode($response, true);
        
    }
    return $responses;
}


    private function getAccessToken($serverApiKey)
    {
        $url = 'https://www.googleapis.com/oauth2/v4/token';
        $data = [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $this->generateJwtAssertion($serverApiKey),
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $body = json_decode($response, true);

        return $body['access_token'];
    }


    private function generateJwtAssertion($serverApiKey)
    {
        $now = time();
        $exp = $now + 3600; // Token expires in 1 hour

        $jwtClaims = [
            'iss' => $this->serviceAccountKey['client_email'],
            'sub' => $this->serviceAccountKey['client_email'],
            'aud' => 'https://www.googleapis.com/oauth2/v4/token',
            'scope' => 'https://www.googleapis.com/auth/cloud-platform',
            'iat' => $now,
            'exp' => $exp,
        ];

        $jwtHeader = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        $base64UrlEncodedHeader = $this->base64UrlEncode(json_encode($jwtHeader));
        $base64UrlEncodedClaims = $this->base64UrlEncode(json_encode($jwtClaims));

        $signatureInput = $base64UrlEncodedHeader.'.'.$base64UrlEncodedClaims;

        $privateKey = openssl_pkey_get_private($this->serviceAccountKey['private_key']);
        openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        openssl_free_key($privateKey);

        $base64UrlEncodedSignature = $this->base64UrlEncode($signature);

        return $signatureInput.'.'.$base64UrlEncodedSignature;
    }



    private function base64UrlEncode($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }



    // public static function send($userDeviceDetail, $notification)
    // {
    //     $serverApiKey = env('FCM_SERVER_KEY');
    //     $payload = [
    //         "notification" => [
    //             "title" => $notification['title'],
    //             "body" => $notification['body']['description'],
    //         ],
    //         "data" => [
    //             "click_action" => "FLUTTER_NOTIFICATION_CLICK",
    //             "body" => $notification['body'],

    //         ],
    //         "android" => [
    //             "priority" => 'high',
    //         ],
    //         "registration_ids" => $userDeviceDetail->pluck('fcmToken')->all(),
    //     ];
    //     $dataString = json_encode($payload);
    //     $headers = [
    //         'Authorization: key=' . $serverApiKey,
    //         'Content-Type: application/json',
    //     ];
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    //     return curl_exec($ch);

	// 	curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
	// 	curl_setopt($ch, CURLOPT_POST, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
	// 	// Set a short timeout to make the request asynchronous
	// 	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	// 	 // Execute the request in the background
	// 	curl_exec($ch);
	// 	// Close the cURL handle
	// 	curl_close($ch);
	// 	return true;
    // }
}
