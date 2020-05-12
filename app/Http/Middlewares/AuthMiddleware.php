<?php

namespace App\Http\Middlewares;

use Carbon\Carbon;
use Slim\Http\Request;
use App\Services\Response;

final class AuthMiddleware
{

    /**
     * @param Request $request
     * @param Response $response
     * @param callable $next
     * @return Response
     */
    public function __invoke(Request $request, Response $response, callable $next): Response
    {
        $token = $request->getAttribute('jwt');

        if (!empty($token)) {
            $tokenExpired = Carbon::parse($token['expired_at'])->format('Y-m-d H:i:s');
            $now          = Carbon::now()->format('Y-m-d H:i:s');

            if ($tokenExpired < $now) {
                return $response->error("Sessão expirada", 401);
            }
        } else {            
            return $response->error("Token inválido", 401);
        }

        $response = $next($request, $response);

        return $response;
    }
}
