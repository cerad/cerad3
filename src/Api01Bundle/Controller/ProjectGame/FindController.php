<?php
namespace Cerad\Bundle\Api01Bundle\Controller\ProjectGame;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindController
{
    protected $gameRepo;
    
    public function __construct($gameRepo)
    {
        $this->gameRepo = $gameRepo;
    }
    public function __invoke(Request $request, $projectId, $gameNumber)
    {
        $game = $this->gameRepo->findOneArrayByProjectNum($projectId,$gameNumber);
        print_r($game);
        
        // Serializing is painful
        $item = array(
            'projectKey' => $game['projectKey'],
            'num'        => $game['num'],
            'dtBeg'      => $game['dtBeg']->format('Y-m-d H:i:s'),
            'venueName'  => $game['venueName'],
            'fieldName'  => $game['fieldName'],
            
            'levelKey'   => $game['levelKey' ],
            'groupType'  => $game['groupType'],
            'groupName'  => $game['groupName'],
            'status'     => $game['status'],
            'teams'      => array(),
        );
        return new JsonResponse($item);
    }
}

?>
