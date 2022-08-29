<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {

        $isLogged = session()->get('isLogged');

        $uri     = $request->getUri();
        $uriPath = $uri->getPath();
        $uriPath = strtolower($uriPath);

        $uriEnabled = [
            'admin/login',
            'admin/login/index',
            'admin/login/authenticate',
            'admin/login/logout',
        ];

        // Permite Logout
        if ($isLogged && in_array($uriPath, $uriEnabled) &&
            $uriPath == 'admin/login/logout') {

            return false;
        }

        // Tira da tela de login se ja estiver logado
        if ($isLogged && in_array($uriPath, $uriEnabled) &&
            $uriPath != 'admin/login/logout') {

            return redirect()->to('admin/home');
        }

        // Permite acesso se estiver logado
        if ($isLogged && !in_array($uriPath, $uriEnabled)) {
            return false;
        }

        // Permite acesso a tela de login se estiver deslogado
        if (!$isLogged && in_array($uriPath, $uriEnabled)) {
            return false;
        }


        return redirect()->to('admin/login');
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request,
                          ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}