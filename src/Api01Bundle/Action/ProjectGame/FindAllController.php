<?php
namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;

use Symfony\Component\HttpFoundation\Request;
//  Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindAllController extends FindBaseController
{
    public function __invoke(Request $request, $projectId)
    {
        $query = $request->query->all();
        $params = array();
        foreach(array('dates') as $key)
        {
            $this->processParam($params,$query,$key);
        }
        // Must have something selected
        if (count($params) < 1) return new JsonResponse(array());
        
        $params['projectKeys'] = array($projectId);
        $params['wantOfficials'] = false;
        
        try
        {
            $games = $this->gameRepo->queryGameSchedule($params);
        }
        catch (\Exception $e)
        {
            die($e->getMessage());
        }
        
        $items = array();
        foreach($games as $game)
        {
            $items[] = $this->serializeGame($game);
        }
        return new JsonResponse($items);
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
