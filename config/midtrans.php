<?php 

return [

    'server_key' => env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-H1ddHHPCI_d_A6lqydKPwWMB'),

    'client_key' => env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-9O6yLCTqDFQgXE83'),

    'env' => env('MIDTRANS_ENV', 'development'),

    'sanitize' => env('MIDTRANS_SANITIZE', 'true'),

    '3ds' => env('MIDTRANS_3DS', 'false'),

    'curl_options' => [

    ],

];
