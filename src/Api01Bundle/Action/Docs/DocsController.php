<?php
namespace Cerad\Bundle\Api01Bundle\Action\Docs;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class DocsController
{
    protected $templating;
    
    public function setTemplating(EngineInterface $templating) { $this->templating = $templating; }
    
    public function __invoke(Request $request)
    {
        $tplName = $request->attributes->get('_template');
        $tplData = array();
        return $this->templating->renderResponse($tplName, $tplData);        
    }
}

?>
