<?php

namespace sp_n1_v3\Mail;

class Mailer
{
    protected $mailer;
    protected $view;

    public function __construct($view, $mailer)
    {
        $this->mailer = $mailer;
        $this->view = $view;
    }

    public function send($template, $data, $callback)
    {
        $message = new Message($this->mailer);
        $this->view->appendData($data);
        $message->Body($this->view->render($template));
        call_user_func($callback, $message);
        try {
            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mailer->ErrorInfo;
        }
    }
}
