<?php

namespace App\Http\Controllers\Auth;

use App\Services\Utils\Response;
use League\OAuth2\Client\Provider\Google;
use Slim\Http\Request;

class AuthController
{
    /**
     * Authentication Google OAuth2
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function googleLogin(Request $request, Response $response): Response
    {
        $provider = new Google([
            'clientId'     => '',
            'clientSecret' => '',
            'redirectUri'  => '',
        ]);

        $error = $request->getQueryParam('error');
        $code  = $request->getQueryParam('code');
        $state = $request->getQueryParam('state');

        if ($error) {

            flash('error', 'You need authorization to continue.');

            return redirect()->url('/');

        } else if (!$code) {

            $authUrl = $provider->getAuthorizationUrl();
            session('oauth2state', $provider->getState());

            return redirect()->url($authUrl);

        } elseif (!$state || $state !== session('oauth2state')) {

            session_flush('oauth2state');
            flash('error', 'Connectio failed.');

            return redirect()->url('/');
        }

        $token = $provider->getAccessToken("authorization_code", ['code' => $code]);

        /** @var \League\OAuth2\Client\Provider\GoogleUser $user */
        $user = $provider->getResourceOwner($token);

        session('user_email', $user->getEmail());
        session('user_name', $user->getName());
        session('user', $user->getId());

        flash('success', 'Login success.');

        return redirect()->url('/');
    }
}
