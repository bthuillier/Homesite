<?php
namespace Bthuillier\Bundle\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Description of BlogController
 *
 * @author bthuillier
 */
class BlogController {
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }    
}
