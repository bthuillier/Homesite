<?php

namespace Bthuillier\Bundle\MainBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Bthuillier\Bundle\MainBundle\Contact\Contact;

/**
 * Description of ContactFormHandler
 *
 * @author bthuillier
 */
class ContactFormHandler {
    
    public function __construct(Form $form, Request $request, \Swift_Mailer $mailer)
    {
        $this->form = $form;
        $this->request = $request;
        $this->mailer = $mailer;
    }
    
    
    public function process(Contact $contact)
    {
        $this->form->setData($contact);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess($contact);
                
                return true;
            }
        }

        return false;
    }
    
    public function getFormView() {
        return $this->form->createView();
    }

    protected function onSuccess(Contact $contact)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($contact->getSubject())
            ->setFrom('benjaminthuillier@gmail.com')
            ->setTo($contact->getMail())
            ->setBody($contact->getBody())
        ;
        $this->mailer->send($message);
        
        $contact->clean();
        $this->form->setData($contact);
    }        
}
