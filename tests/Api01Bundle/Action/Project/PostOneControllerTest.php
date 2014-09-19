<?php

namespace Cerad\Bundle\Api01Bundle\Action\Project;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostOneControllerTest extends WebTestCase
{
    protected $projectId = 'AYSOTestProject';
    
    protected function getJson()
    {
        $data = array('projectId' => $this->projectId);
        
        return json_encode($data);
    }
    public function testPostProjectController()
    {
        $client = static::createClient();

        $data = array('projectId' => $this->projectId);
        
        $request = Request::create('/0.1/project','POST',[],[],[],[],json_encode($data));
        
        $controller = $client->getContainer()->get('cerad_api01__project__post_one__controller');
        
        $response = $controller->__invoke($request);
        
        $this->assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
        $this->assertEquals('/0.1/project/AYSOTestProject',$response->getTargetUrl());
    }
    public function testPostProjectHandle()
    {
        $client = static::createClient();
        
        $kernel = $client->getContainer()->get('kernel');
        
      //echo get_class($kernel) . "\n";
        
        $data = array('projectId' => $this->projectId);
        
        $request = Request::create('/0.1/project','POST',[],[],[],[],json_encode($data));

        $response = $kernel->handle($request);
        
        $this->assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
        $this->assertEquals('/0.1/project/AYSOTestProject',$response->getTargetUrl());
        
    }
    public function testPostProjectWeb()
    {
        $client = static::createClient();
        
        $client->request('POST','0.1/project',[],[],[],$this->getJson());
        
        $response = $client->getResponse();
                
        $this->assertEquals(Response::HTTP_CREATED,$response->getStatusCode());
        $this->assertEquals('/0.1/project/AYSOTestProject',$response->getTargetUrl());
        
    }
}
