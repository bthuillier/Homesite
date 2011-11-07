<?php

namespace CVController;namespace Bthuillier\Bundle\MainBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CVController
 *
 * @author bthuillier
 */
class CVController extends ContainerAware {
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        return array();
    }
}
