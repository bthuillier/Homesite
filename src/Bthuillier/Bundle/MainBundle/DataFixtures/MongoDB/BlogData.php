<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bthuillier\Bundle\MainBundle\DataFixtures\MongoDB;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Bthuillier\Bundle\MainBundle\Document\Blog;
use Doctrine\Common\Persistence\ObjectManager;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogData
 *
 * @author bthuillier
 */
class BlogData extends AbstractFixture implements OrderedFixtureInterface{
    
    public function load(ObjectManager $manager)
    {
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(true);
        $blog->setTitle('lawl');
        $blog->setDescription('still be there');
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);
        
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(true);
        $blog->setTitle('lawl');
        $blog->setDescription('still be there');        
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);        
        
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(true);
        $blog->setTitle('lawl');
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);
        
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(true);
        $blog->setTitle('lawl');
        $blog->setDescription('still be there');        
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);
        
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(true);
        $blog->setTitle('lawl');
        $blog->setDescription('still be there');        
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);
 
        $blog = new Blog();
        $blog->setBody('azertyuiop');
        $blog->setIsActive(false);
        $blog->setTitle('lawl');
        $blog->setDescription('still be there');        
        $blog->setAuthor($manager->merge($this->getReference('admin-user')));
        $manager->persist($blog);
        
        $manager->flush();
        
    }       
    
    public function getOrder()
    {
        return 2;
    }
}
