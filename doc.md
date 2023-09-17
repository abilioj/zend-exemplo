# cria o um modulo "Core"
- cria  uma pasta 'Core' dentro da pasta module, com a estrutura iqual a da pasta 'Application' padrão do zendframework/skeleton-application,
  e registra o novo modele em  .\config\modules.config.php antes de Application, e adicione no autoloado do composer o modulo ' ,"Core\\": "module/Core/src/" '
---------------------------------------------------------------------------------------------------------------------------------------------------------------------
# CONFIG Do Banco de Dado mysql com zend-db

    'db' => [
        'driver'   => 'Pdo_Mysql',
        'host'     => 'locaLhost',
        'database' => 'zend_db_example',
        'username' => 'root',
        'password' => '',
    ]
- no return do arquivo .\config\autoload\global.php adicio a cofiguração acima, e regita em .\config\application.config.php no "service_manager"  adicion a class 
    "Adapter::class => AdapterServiceFactory::class,"

https://docs.zendframework.com/zend-db/adapter/
https://docs.zendframework.com/tutorials/getting-started/database-and-models/
https://docs.zendframework.com/zend-db/result-set/#quick-start
---------------------------------------------------------------------------------------------------------------------------------------------------------------------
# instala o templete  AdminLTE 3 
- copia os arquivo do templete na pasta 'public', e define a estrutura inicial em .\module\Application\view\layout\layout.phtml
---------------------------------------------------------------------------------------------------------------------------------------------------------------------
# manda email - implementando no core

    'mail' => [
        'name'              => 'sandbox.smtp.mailtrap.io', # nome do servidor
        'host'              => 'sandbox.smtp.mailtrap.io', # servidor
        'port'              => 2525, # porta
        'connection_class'  => 'login', # tipo de conexao do zend
        'connection_config' => [
            'from' => 'zf3napratica@teste.com',
            'username' => '3b62c27d4b017d',
            'password' => '********72a4',
            // 'ssl' => 'ssl', # se for envio ssl - gmail usa
            'auth' => 'CRAM-MD5',
        ],
    ]

- primeiro setamos as configurações em .\config\autoload\global.php

https://docs.zendframework.com/zend-mail/transport/intro/
https://mailtrap.io/
---------------------------------------------------------------------------------------------------------------------------------------------------------------------