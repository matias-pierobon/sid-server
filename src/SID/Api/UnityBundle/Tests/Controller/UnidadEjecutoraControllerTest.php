<?php

namespace SID\Api\UnityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UnidadEjecutoraControllerTest extends WebTestCase
{
    /*
    public function testCompleteScenario()
    {
        // Create a new public to browse the application
        $public = static::createClient();

        // Create a new entry in the database
        $crawler = $public->request('GET', '/unidades/');
        $this->assertEquals(200, $public->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /unidades/");
        $crawler = $public->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'sid_api_unitybundle_unidadejecutora[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $public->submit($form);
        $crawler = $public->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $public->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'sid_api_unitybundle_unidadejecutora[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $public->submit($form);
        $crawler = $public->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $public->submit($crawler->selectButton('Delete')->form());
        $crawler = $public->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $public->getResponse()->getContent());
    }

    */
}
