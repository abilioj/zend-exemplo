# cria o um modulo "Core"
- cria  uma pasta 'Core' dentro da pasta module, com a estrutura iqual a da pasta 'Application' padrão do zendframework/skeleton-application,
  e registra o novo modele em  .\config\modules.config.php antes de Application, e adicione no autoloado do composer o modulo 
  
```composer
    ,"Core\\": "module/Core/src/" 
```

---------------------------------------------------------------------------------------------------------------------------------------------------
## CLASS Abstrata de email - implementando no core
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

### <b>Factories</b>

https://docs.zendframework.com/zend-form/helper/form-element-errors/ <br/>
https://docs.zendframework.com/zend-form/quick-start/#creation-via-factory

-- Configurações pra prepara o objeto Transpot pra manada email,pra isso configuramos o serviço Factories de Transport 
- Criarimos um classe em ./modele/Core/src/Factories chamada "TransportSmtpFactory"

```php
namespace Core\Factories;
use Zend\Mail\Transport\SmtpOptions;
use zend\Mail\Transport\Smtp as SMTPTransport;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TransportSmtpFactory implements FactoryInterface{

    /**
     * {@inheritDoc}
    */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        $options = new SmtpOptions($config['mail']);
        $transpot = new SMTPTransport();
        $transpot->setOptions($options);
        return $transpot;
    }    

}
```

- registrando os serviço Facatories de Transport pra funciona em module\Core\config\module.config.php
```php
use Core\Facatories\TransportSmtpFactory;
return [
    'service_manager' => [
        "factories" => [
            "core.transport.smtp" => TransportSmtpFactory::class
        ]
    ]
];
```

-- Agora configuramos o serviço Factories de trata os erros dos formularios do projeto que na verdade é um helper
- Criarimos um classe em ./modele/Core/src/Factories chamada "FormElementErrorsFactory"

```php
namespace Core\Factories;
use Interop\Container\ContainerInterface;
use Zend\Form\View\Helper\FormElementErrors;
use Zend\ServiceManager\Factory\FactoryInterface;
class FormElementErrorsFactory implements FactoryInterface{
    /**
     * {@inheritDoc}
    */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $helper = new FormElementErrors();

        $config = $container->get('config');
        if (isset($config['view_helper_config']['form_element_errors'])) {
            $configHelper = $config['view_helper_config']['form_element_errors'];
            if (isset($configHelper['message_open_format'])) {
                $helper->setMessageOpenFormat($configHelper['message_open_format']);
            }
            if (isset($configHelper['message_separator_string'])) {
                $helper->setMessageSeparatorString($configHelper['message_separator_string']);
            }
            if (isset($configHelper['message_close_string'])) {
                $helper->setMessageCloseString($configHelper['message_close_string']);
            }
        }
        return $helper;
    }    
}
```

-- registrando os serviço Facatories Helper de trata os erros de formularios em  module\Core\config\module.config.php

```php
    use Zend\Form\View\Helper\FormElementErrors;
    use Core\Factories\FormElementErrorsFactory;

    'view_helpers' =>[
        'factories' => [
            FormElementErrors::class => FormElementErrorsFactory::class
        ]
    ]
```
---------------------------------------------------------------------------------------------------------------------------------------------------
