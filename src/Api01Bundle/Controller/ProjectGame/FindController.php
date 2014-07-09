<?php
namespace Cerad\Bundle\Api01Bundle\Controller\ProjectGame;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class FindController
{
    public function __invoke(Request $request)
    {
        $projectKey = $request->attributes->get('projectKey');
        $gameNum    = $request->attributes->get('gameNum');
        
        $game = array(
            'projectKey' => $projectKey,
            'num'        => $gameNum,
            'venueName'  => 'John Hunt',
            'fieldName'  => 'JH03',
        );
        return new JsonResponse($game);
    }
}

?>
