<?php

namespace Core\Factories;
use Zend\Mail\Transport\SmtpOptions;
use zend\Mail\Transport\Smtp as SMTPTransport;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TransportSmtpFactory implements FactoryInterface{

    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');
        $options = new SmtpOptions($config['mail']);
        $transpot = new SMTPTransport();
        $transpot->setOptions($options);
        return $transpot;
    }    

}