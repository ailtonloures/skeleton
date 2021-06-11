<?php
namespace App\Http\Views;

use App\Models\User;
use App\Services\Api\APIView;
use App\Services\Utils\Response;
use Slim\Http\Request;

class ListAndCreateView extends APIView
{
    public function get(Request $request, Response $response)
    {
        $user  = new User;
        $users = $user->paginate($request->getQueryParam('page', 1));

        return $response->json($users);
    }

    public function post(Request $request, Response $response)
    {
        $user = new User;
        $user = $user->create($request->getParsedBody());

        return $response->json($user, 201);
    }
}
