<?php
namespace Bthuillier\Bundle\MainBundle\Controller;

use Bthuillier\Bundle\MainBundle\Document\Blog;
use Bthuillier\Bundle\MainBundle\Form\Type\BlogType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Description of BlogController
 *
 * @author bthuillier
 */
class BlogController extends ContainerAware {
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/new")
     * @Template()
     */    
    public function newAction()
    {
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new BlogType());
        
        $blog = new Blog();
        $form->setData($blog);
        return array("form" => $form->createView());
    }
    
}
