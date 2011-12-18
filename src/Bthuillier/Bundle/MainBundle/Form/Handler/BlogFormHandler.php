<?php

namespace Bthuillier\Bundle\MainBundle\Form\Handler;

use Bthuillier\Bundle\MainBundle\Document\Blog;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Bthuillier\Bundle\MainBundle\Manager\BlogManager;

/**
 * Description of BlogFormHandler
 *
 * @author bthuillier
 */
class BlogFormHandler {
    protected $request;
    protected $userManager;
    protected $form;

    public function __construct(Form $form, Request $request, BlogManager $blogManager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->blogManager = $blogManager;
    }

    public function process(Blog $blog)
    {
        $this->form->setData($blog);

        if ('POST' == $this->request->getMethod()) {
            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $this->onSuccess($blog);

                return true;
            }
        }

        return false;
    }
    
    public function getFormView() {
        return $this->form->createView();
    }

    protected function onSuccess(Blog $blog)
    {
        $this->blogManager->save($blog);
    }    
}
