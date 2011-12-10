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
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        $blogs = $this->getRepository('BthuillierMainBundle:Blog')
                ->findBy(array(), array("publishedAt" => "desc"), 5);
        
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
                $dm = $this->getManager();
                $dm->persist($blog);
                $dm->flush();
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
        $dm = $this->getManager();
        $blog = $this->getRepository('BthuillierMainBundle:Blog')
                ->findOneBy(array('slug' => $slug));
        $dm->remove($blog);
        $dm->flush();
        $url = $this->container->get('router')
                ->generate('bthuillier_main_blog_list');
        return new RedirectResponse($url);
    }

    /**
     * @Route("/show/{slug}")
     * @Template()
     */
    public function showAction($slug) {
        $blog = $this->getRepository('BthuillierMainBundle:Blog')
                ->findOneBy(array('slug' => $slug));
        return array("blog" => $blog);
    }
    
    /**
     * @Route("/{slug}/edit")
     * @Template
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($slug) {
        
        $dm = $this->getManager();
        $blog = $this->getRepository('BthuillierMainBundle:Blog')
                ->findOneBy(array('slug' => $slug));
        
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new BlogType());
        $form->setData($blog);
        $request = $this->container->get('request');
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $dm->persist($blog);
                $dm->flush();
                $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
                return new RedirectResponse($url);
            }
        }
        return array("form" => $form->createView(), "blog" => $blog);
    }

}
