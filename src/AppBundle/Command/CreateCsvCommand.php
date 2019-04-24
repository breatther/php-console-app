<?php

namespace AppBundle\Command;

use AppBundle\Entity\SimplifiedClient;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCsvCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:create-csv')
            ->setDescription('Generate the clients CSV')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $route = $this->getContainer()->get('kernel')->getRootDir()."/../data.xml";

        $clients = $this->getContainer()->get('app.clients.service')->getClientsFromJson();
        $clients = $this->getContainer()->get('app.clients.service')->getClientsFromXml($route, $clients);

        $this->getContainer()->get('app.clients.service')->createClientsCsv($clients);

    }



}