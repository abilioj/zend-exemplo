<?php
/**
 * Global Configuration Override 
 */

return [
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'host'     => 'locaLhost',
        'database' => 'zend_db_example',
        'username' => 'root',
        'password' => '',
    ],
    'mail' => [
        'name'              => 'sandbox.smtp.mailtrap.io', # nome do servidor
        'host'              => 'sandbox.smtp.mailtrap.io', # servidor
        'port'              => 2525, # porta
        'connection_class'  => 'login', # tipo de conexao do zend
        'connection_config' => [
            'from' => 'zf3napratica@teste.com',
            'username' => '3b62c27d4b017d',
            'password' => '32533faf4472a4',
            // 'ssl' => 'ssl', # se for envio ssl - gmail usa
            'auth' => 'CRAM-MD5',
        ],
    ]
];
