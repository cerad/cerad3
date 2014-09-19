<?php
namespace Cerad\Bundle\Api01Bundle\Action\Project;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Cerad\Bundle\CoreBundle\Action\ActionController;

class PostOneController extends ActionController
{
    protected $projectDir;
    
    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }
    public function __invoke(Request $request)
    {
        $data = json_decode($request->getContent(),true);
        
        $projectId = $data['projectId'];
        
        $url = $this->generateUrl('cerad_api01__project__find_one',['projectId' => $projectId]);
        
        return new RedirectResponse($url,Response::HTTP_CREATED);
                
    }
}

?>
