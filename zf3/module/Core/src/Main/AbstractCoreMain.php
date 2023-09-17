<?php
namespace Core\Main;

use zend\View\View; 
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use zend\Mail\Transport\Smtp as SMTPTransport;

abstract class AbstractCoreMain
{
    protected $transport;
    protected $view;
    protected $body;
    protected $message;
    protected $subject;
    protected $to;
    protected $replyTo;
    protected $data;
    protected $page;
    protected $cc;

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

    /**
     * Get the value of transport
     */ 
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set the value of transport
     *
     * @return  self
     */ 
    public function setTransport($transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get the value of view
     */ 
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @return  self
     */ 
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the value of body
     */ 
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of subject
     */ 
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set the value of subject
     *
     * @return  self
     */ 
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get the value of to
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @return  self
     */ 
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get the value of replyTo
     */ 
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * Set the value of replyTo
     *
     * @return  self
     */ 
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;

        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of page
     */ 
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */ 
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get the value of cc
     */ 
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set the value of cc
     *
     * @return  self
     */ 
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }
}