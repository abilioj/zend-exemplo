# zend-exemplo

* cria o projeto - composer create-project -s dev zendframework/skeleton-application zf3

* roda 
```bash
php -S 0.0.0.0:8080 -t public public/index.php 
# || 
composer run --timeout 0 serve
```
* atualizar o projeto a nivel de class 
```bash
composer dump-autoload -o
```
----------------------------------------------------------------------------------------------
## CONFIG Do Banco de Dado mysql com zend-db
```php
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'host'     => 'locaLhost',
        'database' => 'zend_db_example',
        'username' => 'root',
        'password' => '',
    ]
```
- no return do arquivo .\config\autoload\global.php adicio a cofiguração acima, e regita em .\config\application.config.php no "service_manager"  adicion a class 
    "Adapter::class => AdapterServiceFactory::class,"

https://docs.zendframework.com/zend-db/adapter/<br>
https://docs.zendframework.com/tutorials/getting-started/database-and-models/<br>
https://docs.zendframework.com/zend-db/result-set/#quick-start
---------------------------------------------------------------------------------------------------------------------------------------------------
## instala o templete  AdminLTE 3 
- copia os arquivo do templete na pasta 'public', e define a estrutura inicial em .\module\Application\view\layout\layout.phtml

https://adminlte.io/
https://adminlte.io/themes/AdminLTE/index.html
----------------------------------------------------------------------------------------------
## DOCS
* [Core](doc-core.md)
* [Model](doc-model.md)
-----------------------------------------------------------------------------------------------
# Aqui está a lista com todos os componentes que iremos utilizar

    - zendframework/zend-mvc
    - zfcampus/zf-development-mode
    - zendframework/zend-cache
    - zendframework/zend-db
    - zendframework/zend-mvc-form
    - zendframework/zend-json
    - zendframework/zend-mvc-console
    - zendframework/zend-mvc-i18n
    - zendframework/zend-mvc-plugins
    - zendframework/zend-session
    - zendframework/zend-servicemanager-di
    - zendframework/zend-mail
    - zendframework/zend-authentication
    - zendframework/zend-hydrator
    - zendframework/zend-math
    - zendframework/zend-crypt
    - zendframework/zend-paginator
    - zendframework/zend-i18n-resources

    Lembrando que temos que ter algumas bibliotecas ativar em nossa configuração do PHP para que tudo funcione perfeitamente sendo elas:

    - php_intl
    - php_mysqli (por precaução ative esta biblioteca)
    - php_pdo_mysql
    - php_curl
    - php_mbstring
-----------------------------------------------------------------------------------------------

# instalata componete
 - zend db -> 
 ```bash
 composer require zendframework/zend-db
```
# outro
- <b>link :</b> https://docs.zendframework.com/tutorials/getting-started/skeleton-application/