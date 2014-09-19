<?php

namespace Cerad\Bundle\Api01Bundle\Action\Project;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FindOneControllerTest extends WebTestCase
{
    protected $project = '/0.1/project/AYSONationalGames2014';
    
    //  curl local.api.zayso.org/0.1/project/AYSONationalGames2014
    public function testFindProject()
    {
        $client = static::createClient();
        
        $request = Request::create($this->project,'GET');
        $request->headers->set('Accept','application/zayso+json; version=1');
        
      //$client->doRequest($request);
      //$client->request('GET', $this->project);
        
        $response = $client->getKernel()->handle($request); //$client->getResponse();
        
        $this->assertEquals(Response::HTTP_OK,$response->getStatusCode());
        $this->assertEquals('application/json',$response->headers->get('Content-Type'));
        
        $content = $response->getContent();
        
        $project = json_decode($content,true);
        
        $this->assertEquals('AYSONationalGames2014',$project['id']);
        $this->assertEquals(2,count($project['programs']));
        
        $dates = array_keys($project['dates']);
        
        $this->assertEquals('2014-07-04',$dates[2]);
    }
    public function sestFindProjectWithBadKey()
    {
        $client = static::createClient();

        $client->request('GET', $this->project . 'x');
        
        $response = $client->getResponse();
        
        $this->assertEquals(Response::HTTP_NOT_FOUND,$response->getStatusCode());
        $this->assertEquals('No Project For AYSONationalGames2014x',$response->getContent());
        
    }
}
