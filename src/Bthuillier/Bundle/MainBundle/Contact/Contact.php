<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
    
    public function clean() {
        $this->body    = null;
        $this->mail    = null;
        $this->name    = null;
        $this->subject = null;
    }
    
}
