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