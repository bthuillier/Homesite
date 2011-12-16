<?php

namespace Bthuillier\Bundle\MainBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Description of Controller
 *
 * @author bthuillier
 */
class BaseController extends ContainerAware {
    
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
}
