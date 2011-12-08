<?php

namespace Bthuillier\Bundle\MainBundle\Controller;

use Bthuillier\Bundle\MainBundle\Document\Blog;
use Bthuillier\Bundle\MainBundle\Form\Type\BlogType;
use Symfony\Component\DependencyInjection\ContainerAware;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
    public function indexAction() {
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $blogs = $dm->getRepository('BthuillierMainBundle:Blog')->findAll();

        return array("blogs" => $blogs);
    }

    /**
     * @Route("/new")
     * @Template()
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
                $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
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
     */
    public function listAction() {
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $blogs = $dm->getRepository('BthuillierMainBundle:Blog')->findAll();

        return array("blogs" => $blogs);
    }

    /**
     * @Route("/{slug}/delete")
     * @Template()
     */
    public function deleteAction($slug) {
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $blog = $dm->getRepository('BthuillierMainBundle:Blog')->findOneBy(array('slug' => $slug));
        $dm->remove($blog);
        $dm->flush();
        $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
        return new RedirectResponse($url);
    }

    /**
     * @Route("/{slug}/edit")
     * @Template
     */
    public function editAction($slug) {
        
        $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
        $blog = $dm->getRepository('BthuillierMainBundle:Blog')->findOneBy(array('slug' => $slug));
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new BlogType());
        $form->setData($blog);
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $dm = $this->container->get('doctrine.odm.mongodb.document_manager');
                $dm->persist($blog);
                $dm->flush();
                $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
                return new RedirectResponse($url);
            }
        }
        return array("form" => $form->createView(), "blog" => $blog);
    }

}
