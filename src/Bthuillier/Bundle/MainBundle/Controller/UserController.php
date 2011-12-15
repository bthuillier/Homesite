<?php

namespace Bthuillier\Bundle\MainBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Bthuillier\Bundle\MainBundle\Form\Type\UserType;
use Symfony\Component\HttpFoundation\RedirectResponse;
/**
 * Description of UserController
 *
 * @author bthuillier
 */
class UserController extends BaseController {

    /**
     * @Route("/")
     * @Template()
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction() {
        $user = $this->get("security.context")->getToken()->getUser();
        $factory = $this->container->get('form.factory');
        $form = $factory->create(new UserType());
        $form->setData($user);
        $request = $this->container->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $dm = $this->getManager();
                $dm->persist($user);
                $dm->flush();
                $url = $this->container->get('router')->generate('bthuillier_main_user_index');
                return new RedirectResponse($url);
            }
        }        
        return array("user" => $user, "form" => $form->createView());
    }    
}