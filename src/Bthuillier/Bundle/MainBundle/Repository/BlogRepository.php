<?php

namespace Bthuillier\Bundle\MainBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * BlogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogRepository extends DocumentRepository
{
    public function lastBlogs($number = 5) {
        return $this->findBy(array("isActive"=> true), array("publishedAt" => "desc"), $number);
    }
}