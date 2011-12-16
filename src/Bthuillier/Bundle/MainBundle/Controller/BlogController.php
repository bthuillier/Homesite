<?php

namespace Bthuillier\Bundle\MainBundle\Controller;

use Bthuillier\Bundle\MainBundle\Document\Blog;
use Bthuillier\Bundle\MainBundle\Form\Type\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Description of BlogController
 *
 * @author bthuillier
 */
class BlogController extends BaseController {
    
    /**
     * @return \Bthuillier\Bundle\MainBundle\Manager\BlogManager
     */
    protected function getManager() {
        return $this->get("bthuillier.blog_manager");
    }
    
    public function recentBlogsAction() {
        $blogs = $this->getManager()->getRepository()->lastBlogs();
        return $this->get('templating')
                ->renderResponse("BthuillierMainBundle:Blog:recentBlogs.html.twig", 
                        array("blogs" => $blogs));
    }
    
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        $blogs = $this->getManager()->getRepository()->lastBlogs();
        
        return array("blogs" => $blogs);
    }
    
    
    /**
     * @Route("/new")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function newAction() {
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new BlogType());


        $blog = new Blog();
        $form->setData($blog);
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->getManager()->save($blog);
                $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
                return new RedirectResponse($url);
            }
        }
        return array("form" => $form->createView());
    }

    /**
     * @Route("/list")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function listAction() {
        $blogs = $this->getRepository('BthuillierMainBundle:Blog')
                ->findAll();

        return array("blogs" => $blogs);
    }

    /**
     * @Route("/{slug}/delete")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function deleteAction($slug) {
        $blog = $this->getManager()->getBlog($slug);
        $this->getManager()->delete($blog);
        $url = $this->container->get('router')
                ->generate('bthuillier_main_blog_list');
        return new RedirectResponse($url);
    }

    /**
     * @Route("/show/{slug}")
     * @Template()
     */
    public function showAction($slug) {
        $blog = $this->getManager()->getBlog($slug);
        return array("blog" => $blog);
    }
    
    /**
     * @Route("/{slug}/edit")
     * @Template
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($slug) {
        
        $blog = $this->getManager()->getBlog($slug);
        
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new BlogType());
        $form->setData($blog);
        $request = $this->container->get('request');
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $this->getManager()->save($blog);
                $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
                return new RedirectResponse($url);
            }
        }
        return array("form" => $form->createView(), "blog" => $blog);
    }

}
