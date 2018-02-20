<?php

namespace gestionsanteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RendezVousControllerTest extends WebTestCase
{
    public function testListrendezvous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listRendezVous');
    }

}
