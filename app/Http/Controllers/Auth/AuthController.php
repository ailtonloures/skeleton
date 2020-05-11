<?php

namespace App\Http\Controllers\Auth;

use Slim\Http\Request;
use App\Services\Response;
use League\OAuth2\Client\Provider\Google;

class AuthController
{   
    /**
     * Autenticação OAuth2 Google
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function googleLogin(Request $request, Response $response) : Response
    {   
        /** Acessar o console da google e colocar as informações necessárias aqui */
        $provider = new Google([
            'clientId'     => '',
            'clientSecret' => '',
            'redirectUri'  => '',
        ]);

        $error = $request->getQueryParam('error');
        $code  = $request->getQueryParam('code');
        $state = $request->getQueryParam('state');

        if ($error) {

            flash('error', 'Você precisa de autorização para continuar.');

            return $response->redirect('/');

        } else if (!$code) {

            $authUrl = $provider->getAuthorizationUrl(); // Retorna a url de autenticação
            session('oauth2state', $provider->getState()); // Seta o status na sessão

            return $response->redirect($authUrl); // Redireciona para a url de autenticação

        } elseif (!$state || $state !== session('oauth2state')) { // Verifica se o status é válido

            session_flush('oauth2state');
            flash('error', 'Falha ao tentar se autenticar com a Google');

            return $response->redirect('/'); // Redireciona para a página inicial
        }

        $token = $provider->getAccessToken("authorization_code", ['code' => $code]); // Recupera o token da sessão

        /** @var \League\OAuth2\Client\Provider\GoogleUser $user */
        $user = $provider->getResourceOwner($token); // Retorna as informações do usuário

        session('user_email', $user->getEmail());
        session('user_name', $user->getName());
        session('user', $user->getId());

        flash('success', 'Login efetuado com sucesso!');

        return $response->redirect('/');
    }
}
