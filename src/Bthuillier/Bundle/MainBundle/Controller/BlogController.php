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

use Bthuillier\Bundle\MainBundle\Document\Blog;
use Bthuillier\Bundle\MainBundle\Form\Type\BlogType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        return $this->get("bthuillier_main.blog_manager");
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
        
        $blog = new Blog();
        $handler = $this->get("bthuillier_main.blog.form_handler");
        
        if($handler->process($blog)) {
           $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
           return new RedirectResponse($url); 
        }
        return array("form" => $handler->getFormView());
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
        if($blog === null) {
            throw new NotFoundHttpException(\sprintf("l'article avec le slug '%s' n'existe pas", $slug));
        }
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
        if($blog === null) {
            throw new NotFoundHttpException(\sprintf("l'article avec le slug '%s' n'existe pas", $slug));
        }        
        return array("blog" => $blog);
    }

    /**
     * @Route("/{slug}/edit")
     * @Template
     * @Secure(roles="ROLE_ADMIN")
     */
    public function editAction($slug) {
        
        $blog = $this->getManager()->getBlog($slug);
        if($blog === null) {
            throw new NotFoundHttpException(\sprintf("l'article avec le slug '%s' n'existe pas", $slug));
        }         
        $handler = $this->get("bthuillier_main.blog.form_handler");
        
        if($handler->process($blog)) {
           $url = $this->container->get('router')->generate('bthuillier_main_blog_list');
           return new RedirectResponse($url); 
        }
        return array("form" => $handler->getFormView(), "blog" => $blog);
    }
    
    /**
     * @Route("/feed.{_format}",requirements={"_format" = "xml"})
     * @Template
     */
    public function feedAction() {
        $blogs = $this->getManager()->getRepository()->lastBlogs();
        $firstBlog  = $this->getManager()->getRepository()->getFirstBlog();
        return array('firstBlog' => $firstBlog,'blogs' => $blogs);
    }

}
