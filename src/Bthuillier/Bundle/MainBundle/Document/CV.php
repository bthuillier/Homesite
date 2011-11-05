<?php

namespace Bthuillier\Bundle\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class CV {
    
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
  

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }
}
