<?php


namespace Tests\Controller;


use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testEnclosuresAreShownOnTheHomepage()
    {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/');

        $this->assertStatusCode(200, $client);

        $table = $crawler->filter('.table-enclosure');
        $this->assertCount(3, $table->filter('tbody tr'));
    }
}
