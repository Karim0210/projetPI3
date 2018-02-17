<?php

namespace gestionsanteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testListearticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listeArticle');
    }

}
