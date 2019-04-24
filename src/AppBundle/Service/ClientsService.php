<?php

namespace AppBundle\Service;

use AppBundle\Entity\SimplifiedClient;

class ClientsService
{
    const HEADERS = ["Nombre", "Email", "Telefono", "Compañia"];
    const DELIMITER = ';';
    const ENCLOSURE = '"';

    public function getClientsFromJson()
    {
        $clients = [];
        $data = json_decode(file_get_contents('https://jsonplaceholder.typicode.com/users'), true);

        foreach ($data as $client){
            $clients[] = new SimplifiedClient($client['name'],$client['email'],$client['phone'],$client['company']['name']);
        }

        return $clients;
    }

    public function getClientsFromXml($route, $clients = [])
    {
        if(file_exists($route)) {
            $data = simplexml_load_file($route);
            foreach ($data as $client) {
                $clients[] = new SimplifiedClient(
                    $client['name']->__toString(),$client->__toString(),$client['phone']->__toString(),$client['company']->__toString()
                );
            }
        }

        return $clients;
    }

    public function createClientsCsv($clients, $test = '')
    {
        $fp = fopen('web/clients-'.$test.date('Y-m-d').'.csv', 'w');
        fputcsv($fp, $this::HEADERS , $this::DELIMITER, $this::ENCLOSURE);

        foreach ($clients as $client) {
            fputcsv($fp, $client->toArray(), $this::DELIMITER, $this::ENCLOSURE);
        }

        fclose($fp);
    }

}
