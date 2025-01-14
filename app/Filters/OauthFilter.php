<?php

namespace App\Filters;

use OAuth2\Request;
use OAuth2\Response;
use App\Libraries\Oauth;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class OauthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $oauth = new Oauth();
        $request = Request::createFromGlobals();
        $response = new Response();

        if (!$oauth->server->verifyResourceRequest($request)){
            $oauth->server->getResponse()->send();
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}