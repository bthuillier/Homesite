<?php
namespace Bthuillier\Bundle\MainBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;


class DisqusHelper extends Helper {
    protected $templating;
    protected $developer;
    protected $appName;

    public function __construct(EngineInterface $templating, $appName, $developer = 0)
    {
        $this->templating  = $templating;
        $this->developer   = $developper;
        $this->appName     = $appName;
    }

    /**
     * Returns the HTML necessary for initializing the JavaScript SDK.
     *
     * The default template includes the following parameters:
     *
     *  * async
     *  * fbAsyncInit
     *  * appId
     *  * xfbml
     *  * oauth
     *  * status
     *  * cookie
     *  * logging
     *  * culture
     *
     * @param array  $parameters An array of parameters for the initialization template
     * @param string $name       A template name
     *
     * @return string An HTML string
     */
    public function initialize($disqus_identifier, $parameters = array(), $name = null)
    {
        $name = $name ?: 'BthuillierMainBundle::disqus.html.twig';
        return $this->templating->render($name, $parameters + array(
            'disqus_identifier'  => $disqus_identifier,
            'disqus_shortname'   => $this->appName,
            'developer'          => $this->developer,
        ));
    }


    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'disqus';
    }	
}