<?php
namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindOneController
{
    protected $gameRepo;
    
    public function __construct($gameRepo)
    {
        $this->gameRepo = $gameRepo;
    }
    public function __invoke(Request $request, $projectId, $gameNumber)
    {
        $game = $this->gameRepo->findOneByProjectNum($projectId,$gameNumber);
        if (!$game)
        {
            return new Response(sprintf('No Project Game For %s %s',$projectId,$gameNumber),Response::HTTP_NOT_FOUND);
        }
        // Serializing is painful
        $item = array(
            'projectKey' => $game->getProjectKey(),
            'num'        => $game->getNum(),
            'dtBeg'      => $game->getDtBeg()->format('Y-m-d H:i:s'),
            'dtEnd'      => $game->getDtEnd()->format('Y-m-d H:i:s'),
            'venueName'  => $game->getVenueName(),
            'fieldName'  => $game->getFieldName(),
            
            'levelKey'   => $game->getLevelKey(),
            'groupType'  => $game->getGroupType(),
            'groupName'  => $game->getGroupName(),
            'status'     => $game->getStatus(),
            'teams'      => array(),
        );
        return new JsonResponse($item);
    }
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
