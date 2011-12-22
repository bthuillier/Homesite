<?php

namespace Bthuillier\Bundle\MainBundle\DataFixtures\MongoDB;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Bthuillier\Bundle\MainBundle\Document\User;
/**
 * Description of UserData
 *
 * @author bthuillier
 */
class UserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    
    /**
     * @var Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function load($manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = new User();
        $user->setUsername('John');
        $user->setEmail('john.doe@example.com');
        $user->setPlainPassword('nabix4');
        $user->addRole("ROLE_ADMIN");
        $user->setEnabled(true);
        $userManager->updateUser($user, false);
        $manager->persist($user);
        $manager->flush();
        $this->addReference('admin-user', $user);
    }    
    
    public function getOrder()
    {
        return 1;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }    
}
