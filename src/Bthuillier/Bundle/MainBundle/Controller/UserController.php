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
class UserController extends MongoController {

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
                $dm = $this->getDocumentManager();
                $dm->persist($user);
                $dm->flush();
                $url = $this->container->get('router')->generate('bthuillier_main_user_index');
                return new RedirectResponse($url);
            }
        }        
        return array("user" => $user, "form" => $form->createView());
    }    
}
