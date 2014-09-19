<?php

namespace Cerad\Bundle\Api01Bundle\Misc;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryTest extends WebTestCase
{
    public function test1()
    {
        $client = static::createClient();
        $conn = $client->getContainer('doctrine.dbal.games_connection');
        
                
      //$this->assertEquals('AYSONationalGames2014',$project['id']);
      //$this->assertEquals(2,count($project['programs']));
        
        return;
    }
}
