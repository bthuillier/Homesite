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
    
    protected function connect() {
       $client = static::createClient();
       $crawler = $client->request('GET', '/login');
       
        $form = $crawler
            ->filter('form input[type=submit]')
            ->form(array(
            '_username' => 'John',
            '_password' => 'nabix4'
        ));
        
        $client->submit($form);
        
        return $client;
    }
    
    public function testIndexAsAdmin() {
        $client = $this->connect();
        
        $crawler = $client->request('GET', '/blog/');

        $this->assertTrue($crawler->filter('article')->count() == 5);
        $this->assertTrue($crawler->filter('.active a:contains("Blog")')->count() > 0);
        $this->assertTrue($crawler->filter('.success:contains("Nouveau")')->count()> 0);
        $this->assertTrue($crawler->filter('.primary:contains("Editer")')->count()== 5);
        
    }
      
    
    public function testIndexAsAnonymous() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/');

        $this->assertTrue($crawler->filter('article')->count() == 5);
        $this->assertTrue($crawler->filter('.active a:contains("Blog")')->count() > 0);
        $this->assertEquals($crawler->filter('.success:contains("Nouveau")')->count(), 0, "No add button");
        $this->assertEquals($crawler->filter('.primary:contains("Editer")')->count(), 0, "No edit button");
    }
    
    public function testEditAsAnonymous() {
        $client = static::createClient();
        $blog = $this->getBlog($client);
        
        $crawler = $client->request('GET', \sprintf('/blog/%s/edit', $blog->getSlug()));
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
        
        $crawler = $client->request('GET', \sprintf('/blog/%s/edit', 'nimporteQuoi'));
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
    }
    
    public function testEditAsAdmin() {
        $client = $this->connect();
        $blog = $this->getBlog($client);
        
        $crawler = $client->request('GET', \sprintf('/blog/%s/edit', $blog->getSlug()));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $form = $crawler->filter('form input[type=submit]')->form(array(
            'bthuillier_main_blog_form[isActive]' => $blog->getIsActive(),
            'bthuillier_main_blog_form[body]' => $blog->getBody(),
            'bthuillier_main_blog_form[title]' => $blog->getTitle(),
            'bthuillier_main_blog_form[description]' => $blog->getTitle(),
        ));
        
        $client->submit($form);
        
        $this->assertTrue($client->getResponse()->isRedirect('/blog/list'));        
        $crawler = $client->request('GET', '/blog/list');
        $this->assertTrue($crawler->filter(\sprintf('td:contains("%s")',$blog->getTitle()))->count() > 0); 
        
        $crawler = $client->request('GET', \sprintf('/blog/%s/edit', 'nimporteQuoi'));
        $this->assertEquals(404, $client->getResponse()->getStatusCode());   
    }
    
    public function testNewAsAnonymous() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));        
    }

    public function testNewAsAdmin() {
        $client = $this->connect();
        
        $crawler = $client->request('GET', '/blog/new');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $form = $crawler->filter('form input[type=submit]')->form(array(
            'bthuillier_main_blog_form[isActive]' => true,
            'bthuillier_main_blog_form[body]' => 'fsvfggfgdsfqfdsqfqdsfqsdfqsdg',
            'bthuillier_main_blog_form[description]' => 'a blog post',
            'bthuillier_main_blog_form[title]' => 'sqfdsfsf'
        ));
        
        $client->submit($form);
        
        $this->assertTrue($client->getResponse()->isRedirect('/blog/list'));        
        $crawler = $client->request('GET', '/blog/list');
        $this->assertTrue($crawler->filter('td:contains("sqfdsfsf")')->count() > 0);
        
    }    
    
    public function testList() {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/list');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
        
        $client = $this->connect();
        $crawler = $client->request('GET', '/blog/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testDelete() {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/blog/azerty/delete');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/login'));
        
        $client = $this->connect();
        $crawler = $client->request('GET', '/blog/zerfzfd/delete');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        
        $crawler = $client->request('GET', '/blog/sqfdsfsf/delete');
        $this->assertEquals(302,$client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isRedirect('/blog/list'));
        
    }
    
    public function testFeed() {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/blog/feed.xml');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());   
        $this->assertTrue($crawler->filter('feed')->count() > 0);
        $this->assertTrue($crawler->filter('entry')->count() > 0 && $crawler->filter('entry')->count() <= 5);
    }
    
    protected function getDoctrine($client) {
        return $client
            ->getContainer()
            ->get('doctrine.odm.mongodb');
    }
    
    protected function getBlog($client) {
        $blogs = $this->getDoctrine($client)->getRepository('BthuillierMainBundle:Blog')
                ->findAll();
        foreach($blogs as $blog) {
            return $blog;
        }
    }
    
}