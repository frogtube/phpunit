<?php


namespace Tests\AppBundle\Controller;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testEnclosureAreShownOnTheHomepage()
    {
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);
    }
}