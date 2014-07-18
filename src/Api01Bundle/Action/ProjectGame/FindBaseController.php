<?php
namespace Cerad\Bundle\Api01Bundle\Action\ProjectGame;


class FindBaseController
{
    protected $gameRepo;
    
    public function __construct($gameRepo)
    {
        $this->gameRepo = $gameRepo;
    }
    protected function processParam(&$params,$query,$key)
    {
        // Make sure have something
        if (!isset($query[$key])) return;
        
        $params[$key] = explode(',',$query[$key]);
    }
    protected function serializeGame($game)
    {
        // Serializing is painful
        $gameItem = array(
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
        foreach($game->getTeams() as $team)
        {
            $teamItem = array(
              'slot'     => $team->getSlot(),
              'role'     => $team->getRole(),
              'teamKey'  => $team->getTeamKey(),
              'teamName' => $team->getTeamName(),
            );
            $gameItem['teams'][] = $teamItem;
        }
        return $gameItem;
    }
}

?>
