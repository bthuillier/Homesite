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
        $this->assertTrue($crawler->filter('.active a:contains("Blog")')->count() > 0);
        $this->assertEquals($crawler->filter('.success:contains("Nouveau")')->count(), 0, "No add button");
        $this->assertEquals($crawler->filter('.primary:contains("Editer")')->count(), 0, "No edit button");
    }
    
    public function testNew() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));        
    }
    
    public function testList() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/new');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));          
    }    
    
}
