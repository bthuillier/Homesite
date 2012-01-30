<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bthuillier\Bundle\MainBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bthuillier\Bundle\MainBundle\Form\Type\ContactType;
use Bthuillier\Bundle\MainBundle\Contact\Contact;


/**
 * Description of MainController
 *
 * @author bthuillier
 */
class MainController extends MongoController {
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/CV")
     * @Template()
     */
    public function CVAction() {
        return array();
    }
    
    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction() {
        $handler = $this->get("bthuillier_main.contact.form_handler");
        $contact = new Contact();
        if($handler->process($contact))  {
            
        }

        return array('form' => $handler->getFormView());
    }    
}
