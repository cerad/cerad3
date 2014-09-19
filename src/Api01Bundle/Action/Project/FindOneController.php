<?php
namespace Cerad\Bundle\Api01Bundle\Action\Project;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class FindOneController
{
    protected $projectDir;
    
    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }
    public function __invoke(Request $request, $projectId)
    {
        // [accept] => [0] => text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
        //             [0] => application/zayso+json:version 1
        
        $headers = $request->headers->all();
        print_r($headers);
      //die();
        
        $projectId = $request->attributes->get('projectId');
        
        $projectFile = $this->projectDir . $projectId . '.yml';
        if (!is_file($projectFile))
        {
            return new Response(sprintf('No Project For %s',$projectId),Response::HTTP_NOT_FOUND);
        }
        $project = Yaml::parse(file_get_contents($projectFile));
        
        return new JsonResponse($project);
        
    }
}

?>
