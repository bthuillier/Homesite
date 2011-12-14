<?php
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
class MainController extends ContainerAware {
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
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new ContactType());

        $blog = new Contact();
        $form->setData($blog);
        return array('form' => $form->createView());
    }    
}
