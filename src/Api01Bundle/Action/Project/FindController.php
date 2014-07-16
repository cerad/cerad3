<?php
namespace Cerad\Bundle\Api01Bundle\Action\Project;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class FindController
{
    protected $projectDir;
    
    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }
    public function __invoke(Request $request, $projectId)
    {
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
