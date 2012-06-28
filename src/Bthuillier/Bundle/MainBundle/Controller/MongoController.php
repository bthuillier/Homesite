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
 * Description of MongoController
 *
 * @author Benjamin Thuillier <benjaminthuillier@gmail.com>
 */
class MongoController extends BaseController{

    /**
     * 
     * @return Doctrine\Bundle\MongoDBBundle\ManagerRegistry
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
