# cria o um modulo "Core"
- cria  uma pasta 'Core' dentro da pasta module, com a estrutura iqual a da pasta 'Application' padrão do zendframework/skeleton-application,
  e registra o novo modele em  .\config\modules.config.php antes de Application, e adicione no autoloado do composer o modulo ' ,"Core\\": "module/Core/src/" '
---------------------------------------------------------------------------------------------------------------------------------------------------
# CONFIG Do Banco de Dado mysql com zend-db
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

https://docs.zendframework.com/zend-db/adapter/
https://docs.zendframework.com/tutorials/getting-started/database-and-models/
https://docs.zendframework.com/zend-db/result-set/#quick-start
---------------------------------------------------------------------------------------------------------------------------------------------------
# instala o templete  AdminLTE 3 
- copia os arquivo do templete na pasta 'public', e define a estrutura inicial em .\module\Application\view\layout\layout.phtml

https://adminlte.io/
https://adminlte.io/themes/AdminLTE/index.html
---------------------------------------------------------------------------------------------------------------------------------------------------
# CLASS Abstrata de email - implementando no core
https://docs.zendframework.com/zend-mail/transport/intro/
https://mailtrap.io/

```php
    'mail' => [
        'name'              => 'sandbox.smtp.mailtrap.io', # nome do servidor
        'host'              => 'sandbox.smtp.mailtrap.io', # servidor
        'port'              => 2525, # porta
        'connection_class'  => 'login', # tipo de conexao do zend
        'connection_config' => [
            'from' => 'zf3napratica@teste.com',
            'username' => '********017d',
            'password' => '********72a4',
            // 'ssl' => 'ssl', # se for envio ssl - gmail usa
            'auth' => 'CRAM-MD5',
        ],
    ]
``` 

- primeiro setamos as configurações acima em .\config\autoload\global.php
- em .\module\Core\src vamos criar a pasta "Mail", e nela a abstract class chamada "AbstractCoreMain" com as propriedade em protected "transport,view,body,message,subject,to,replyTo,data,page,cc" com seus gets e sets. OBS "os sets retona a propria instacia".
- cria os metodos e usando as seginte libs:

```php
    namespace Core\Mail;

    use zend\View\View; 
    use Zend\Mail\Message;
    use Zend\Mime\Message as MimeMessage;
    use Zend\Mime\Part as MimePart;
    use zend\Mail\Transport\Smtp as SMTPTransport;

    public function __construct(SMTPTransport $transport, View $view, $page) { 
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    abstract public function renderView($page, array $data);

    public function prepare() {
        
        $html = new MimePart($this->renderView($this->page,$this->data));
        $html->type = 'text/html';

        // montando nosso corpo do email
        $body = new MimeMessage();
        $body->setParts([$html]);
        $this->body = $body;

        //pega as configuração do nosso sevidor de email
        $config = $this->transport->getOptions()->toArray();

        // montando nossa message
        $this->message = new Message();
        $this->message->addFrom($config['connection_config']['from'])
        ->addTo($this->to)
        ->setSubject($this->subject)
        ->setBody($this->body);
        
        if($this->cc) $this->message->addCc($this->cc);
        if($this->replyTo) $this->message->addReplyTo($this->replyTo);

        return $this;
    }

    public function send() {
        $this->transport->send($this->message);
    }

```

** Facatories Configurações pra manada email

https://docs.zendframework.com/zend-form/helper/form-element-errors/ <br/>
https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory

- Criarimos um classe em ./modele/Core/src/Facatories chamada "TransportSmtpFacatory"
---------------------------------------------------------------------------------------------------------------------------------------------------

---------------------------------------------------------------------------------------------------------------------------------------------------