<?php

namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Response;

class FindOneControllerTest extends WebTestCase
{
    protected $project = '/0.1/project/AYSONationalGames2014/';
    
    public function testRequestNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/project/natgames/games/11001');  // games instead of game
        
        $response = $client->getResponse();

        $statusCode = $response->getStatusCode();
        $statusText = Response::$statusTexts[$statusCode];
        
        $this->assertEquals('Symfony\Component\HttpFoundation\Response',get_class($response));
        $this->assertEquals(Response::HTTP_NOT_FOUND,$response->getStatusCode());
        $this->assertEquals('Not Found',$statusText);
        $this->assertEquals('text/html; charset=UTF-8',$response->headers->get('Content-Type'));
    }
    //  curl local.api.zayso.org/0.1/project/AYSONationalGames2014/game/11001
    public function testFindProjectGame()
    {
        $client = static::createClient();

        $client->request('GET', $this->project . 'game/11001');
        
        $response = $client->getResponse();
        
        $this->assertEquals(Response::HTTP_OK,$response->getStatusCode());
        $this->assertEquals('application/json',$response->headers->get('Content-Type'));
        
        $content = $response->getContent();
        
        $game = json_decode($content,true);
        
        $this->assertEquals(11001,$game['num']);
        
        $this->assertEquals('Toyota Sports Complex',$game['venueName']);
        $this->assertEquals('MA1',$game['fieldName']);
        $this->assertEquals('2014-07-03 10:30:00',$game['dtBeg']);
    }
    public function testFindProjectGameWithBadNumber()
    {
        $client = static::createClient();

        $client->request('GET', $this->project . 'game/91001');
        
        $response = $client->getResponse();
        
        $this->assertEquals(Response::HTTP_NOT_FOUND,$response->getStatusCode());
        $this->assertEquals('No Project Game For AYSONationalGames2014 91001',$response->getContent());
        
    }
}
