<?php
/*
 * This file is part of the Homesite project.
 *
 * (c) Benjamin Thuillier <http://blog.bthuillier.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bthuillier\Bundle\MainBundle\Twig\Extension;

use Bthuillier\Bundle\MainBundle\Templating\Helper\DisqusHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Benjamin Thuillier <benjaminthuillier@gmail.com>
 */
class DisqusExtension extends \Twig_Extension{
    
    
    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Returns a list of global functions to add to the existing list.
     *
     * @return array An array of global functions
     */
    public function getFunctions()
    {
        return array(
            'disqus_initialize' => new \Twig_Function_Method($this, 'renderInitialize', array('is_safe' => array('html'))),
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'disqus';
    }

    /**
     * @see DisqusHelper::initialize()
     */
    public function renderInitialize($disqus_identifier,$parameters = array(), $name = null)
    {
        return $this->container->get('bthuillier_disqus.helper')->initialize($disqus_identifier, $parameters, $name ?: 'BthuillierMainBundle::disqus.html.twig');
    }    
    
    
}
