<?php

namespace Bthuillier\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogControllerTest
 *
 * @author bthuillier
 */
class BlogControllerTest extends WebTestCase {
    
    public function testIndex() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/');

        $this->assertTrue($crawler->filter('article')->count() == 5);        
    }
}
