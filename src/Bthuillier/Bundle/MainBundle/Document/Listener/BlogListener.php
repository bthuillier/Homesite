<?php

namespace Bthuillier\Bundle\MainBundle\Document\Listener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Events;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Bthuillier\Bundle\MainBundle\Document\Blog;
use Symfony\Component\Security\Core\SecurityContext;
/**
 * Description of BlogListener
 *
 * @author bthuillier
 */
class BlogListener implements EventSubscriber {

    protected $container;
    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
    
    public function getSubscribedEvents() {
        return array(Events::prePersist);
    }

    public function prePersist(LifecycleEventArgs $args) {
        $this->handleEvent($args);
    }

    protected function handleEvent(LifecycleEventArgs $args) {

        $document = $args->getDocument();
        if($document instanceof Blog) {
            if($this->container->get("security.context")->getUser()){
                $document->setAuthor($this->container->get("security.context")->getUser());
            }
        }
        
    }

}
