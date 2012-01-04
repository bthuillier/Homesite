<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bthuillier\Bundle\MainBundle\Manager;

use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * Description of BaseManager
 *
 * @author bthuillier
 */
abstract class BaseManager {
    /**
     *
     * @var Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $dm;
    
    
    public function __construct(DocumentManager $dm) {
        $this->dm = $dm;
    }
    
    public function save($document) {
        $this->persistAndFlush($document);
    }
    
    public function delete($document) {
        $this->removeAndFlush($document);
    }
    
    protected function removeAndFlush($document) {
        $this->dm->remove($document);
        $this->dm->flush();
    }
    
    protected function persistAndFlush($document) {
        $this->dm->persist($document);
        $this->dm->flush();
    }
    
    
    
}
