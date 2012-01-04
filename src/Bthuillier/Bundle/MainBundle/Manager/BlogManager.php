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
     * @param string $slug 
     * 
     * @return \Bthuillier\Bundle\MainBundle\Document\Blog
     */
    public function getBlogActive($slug) {
        return $this->repository->findOneBy(array('slug' => $slug, 'isActive' => true));
    }
    /**
     *
     * @return \Bthuillier\Bundle\MainBundle\Repository\BlogRepository
     */
    public function getRepository(){
        return $this->repository;
    }
}
