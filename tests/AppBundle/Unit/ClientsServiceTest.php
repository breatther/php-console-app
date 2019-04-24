<?php

namespace Tests\AppBundle\Unit;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientsServiceTest extends WebTestCase
{
    const NUM_XML_CLIENTS = 20;

    public function testGetClientsFromJson()
    {
        self::bootKernel();

        $clients = self::$kernel->getContainer()->get('app.clients.service')->getClientsFromJson();
        $this->assertTrue(sizeof($clients) > 0);
    }

    public function testGetClientsFromXMLWithValidRoute()
    {
        self::bootKernel();
        $route = self::$kernel->getContainer()->get('kernel')->getRootDir()."/../data.xml";

        $clients = self::$kernel->getContainer()->get('app.clients.service')->getClientsFromXml($route);
        $this->assertTrue(sizeof($clients) == self::NUM_XML_CLIENTS);
    }

    public function testGetClientsFromXMLWithInvalidRoute()
    {
        self::bootKernel();
        $route = self::$kernel->getContainer()->get('kernel')->getRootDir()."/../data2.xml";

        $clients = self::$kernel->getContainer()->get('app.clients.service')->getClientsFromXml($route);
        $this->assertEquals([], $clients);
    }

    public function testCreateClientCsv()
    {
        if(file_exists('web/clients-test'.date('Y-m-d').'.csv')){
            unlink('web/clients-test'.date('Y-m-d').'.csv');
        }

        self::bootKernel();
        $clients = self::$kernel->getContainer()->get('app.clients.service')->getClientsFromJson();

        self::$kernel->getContainer()->get('app.clients.service')->createClientsCsv($clients, 'test');

        $this->assertTrue(file_exists('web/clients-test'.date('Y-m-d').'.csv'));

    }

}
