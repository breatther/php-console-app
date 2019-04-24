<?php

namespace Tests\AppBundle\Unit;

use AppBundle\Entity\SimplifiedClient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

class ClientTest extends WebTestCase
{
    public function testCreateIncorrectClient()
    {
        $this->expectException(InvalidArgumentException::class);
        new SimplifiedClient();
    }

    public function testCreateCorrectClient()
    {
        $client = new SimplifiedClient('Name', 'Email', 'Phone', 'Company');
        $this->assertTrue($client instanceof SimplifiedClient);
    }
}
