<?php
namespace App\Http\Views;

use App\Models\User;
use App\Services\APIView;
use App\Services\Response;
use Slim\Http\Request;

class ListAndCreateView extends APIView
{
    public function get(Request $request, Response $response)
    {
        # implements here
        $user  = new User;
        $users = $user->query()->execute()->fetchAll('assoc');

        return response()->json($users);
    }

    public function post(Request $request, Response $response)
    {
        # implements here
        $user = new User;

        $user = $user->create($request->getParsedBody());

        return response()->json("Saved", 201);
    }

    public function put(Request $request, Response $response)
    {
        # implements here
    }

    public function delete(Request $request, Response $response)
    {
        # implements here
    }
}
