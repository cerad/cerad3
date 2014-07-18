<?php
namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindOneController extends FindBaseController
{
    protected $gameRepo;
   
    public function __invoke(Request $request, $projectId, $gameNumber)
    {
        $game = $this->gameRepo->findOneByProjectNum($projectId,$gameNumber);
        if (!$game)
        {
            return new Response(sprintf('No Project Game For %s %s',$projectId,$gameNumber),Response::HTTP_NOT_FOUND);
        }
        $item = $this->serializeGame($game);
        
        return new JsonResponse($item);
    }
    /* ====================================================================
     * Not currently used
     */
    public function __invokeArray(Request $request, $projectId, $gameNumber)
    {
        $game = $this->gameRepo->findOneArrayByProjectNum($projectId,$gameNumber);
        
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
