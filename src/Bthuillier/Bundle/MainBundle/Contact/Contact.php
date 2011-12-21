<?php

namespace Bthuillier\Bundle\MainBundle\Contact;

/**
 * Description of Contact
 *
 * @author bthuillier
 */
class Contact {

    protected $mail;
    protected $name;
    protected $subject;
    protected $body;
    

    public function getMail() {
        return $this->mail;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getSubject() {
        return $this->subject;

    }
    
    public function getBody() {
        return $this->body;
    }
    
    public function setMail($mail) {
        $this->mail = $mail;
    }
    
    public function setBody($body) {
        $this->body = $body;
    }
    
    public function setSubject($subject) {
        $this->subject = $subject;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    
}
