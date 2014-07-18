<?php

namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;

class FindAllControllerTest extends WebTestCase
{
    protected $project = '/0.1/project/AYSONationalGames2014/';
    
    //  curl local.api.zayso.org/0.1/project/AYSONationalGames2014/game/11001
    public function testFindProjectGames()
    {
        $client = static::createClient();

        $client->request('GET', $this->project . 'games?dates=2014-07-04');
        
        $response = $client->getResponse();
        
        $this->assertEquals(Response::HTTP_OK,$response->getStatusCode());
        
        $content = $response->getContent();
        
        $games = json_decode($content,true);
        
        $this->assertEquals(459,count($games));
        
        return;
    }
}
