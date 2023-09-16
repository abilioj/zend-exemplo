# zend-exemplo

* cria o projeto - composer create-project -s dev zendframework/skeleton-application zf3

* roda - php -S 0.0.0.0:8080 -t public public/index.php

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
 - zend db -> composer require zendframework/zend-db

# outro
- <b>link :</b> https://docs.zendframework.com/tutorials/getting-started/skeleton-application/