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

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Description of Controller
 *
 * @author bthuillier
 */
class BaseController extends ContainerAware {
    
    /**
     * @param string $id the id of a service
     *
     * @return a service
     */
    protected function get($id) {
        return $this->container->get($id);
    }
    
    /**
     * 
     * @return Symfony\Bundle\DoctrineMongoDBBundle\ManagerRegistry
     */
    protected function getDoctrine() {
        return $this->container->get('doctrine.odm.mongodb');
    }
    

    /**
     * @return Doctrine\ODM\MongoDB\DocumentManager
     */
    protected function getDocumentManager() {
        return $this->getDoctrine()->getManager();
    }
    
    /**
     * @param string $documentName  The name of the Document.
     * 
     * @return \Doctrine\ODM\MongoDB\DocumentRepository
     */
    protected function getRepository($documentName) {
        return $this->getDoctrine()->getRepository($documentName);
    }
    
    /**
     *
     * @return \Symfony\Component\Form\FormFactory
     */
    protected function getFormFactory() {
        return $this->container->get('form.factory');
    }
}
