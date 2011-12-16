<?php

namespace Bthuillier\Bundle\MainBundle\Manager;
use Doctrine\ODM\MongoDB\DocumentManager;
use Bthuillier\Bundle\MainBundle\Repository\BlogRepository;

/**
 * Description of BlogManager
 *
 * @author bthuillier
 */
class BlogManager extends BaseManager{
    /**
     *
     * @var \Bthuillier\Bundle\MainBundle\Repository\BlogRepository
     */
    protected $repository;


    public function __construct(DocumentManager $dm) {
        parent::__construct($dm);    
        $this->repository = $dm->getRepository("BthuillierMainBundle:Blog");
    }


    /**
     *
     * @param string $slug 
     * 
     * @return \Bthuillier\Bundle\MainBundle\Document\Blog
     */
    public function getBlog($slug) {
        return $this->repository->findOneBy(array('slug' => $slug));
    }
    

    /**
     *
     * @return \Bthuillier\Bundle\MainBundle\Repository\BlogRepository
     */
    public function getRepository(){
        return $this->repository;
    }
}
