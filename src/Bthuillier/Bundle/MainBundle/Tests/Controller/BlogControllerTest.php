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
    
    public function testIndexAsAnonymous() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/');

        $this->assertTrue($crawler->filter('article')->count() == 5);
        $this->assertTrue($crawler->filter('#active a:contains("Blog")')->count() > 0);
    }
}
