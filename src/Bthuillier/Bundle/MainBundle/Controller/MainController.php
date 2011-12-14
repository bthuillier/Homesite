<?php
namespace Bthuillier\Bundle\MainBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


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
        return array();
    }    
}
