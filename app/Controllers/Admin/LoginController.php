<?php

namespace App\Controllers\Admin;

/**
 * Description of Login
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class LoginController extends \App\Controllers\BaseController
{
    public $module = 'Login';

    public function index()
    {
        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Login';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================

        $data['action'] = base_url('admin/login/authenticate');

        # =================================
        # Return View
        # =================================

        return $this->viewSingle('Admin/LoginController/index', $data);
    }

    private function setUserSession($client): void
    {
        $data = [
            'admin'    => [
                'id'        => $client['id'],
                'email'     => $client['email'],
                'firstName' => $client['firstName'],
                'lastName'  => $client['lastName'],
            ],
            'isLogged' => true,
        ];

        $session = session();
        $session->set($data);
    }

    public function authenticate()
    {
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $userIp            = $this->request->getIPAddress();
        $status            = $this->recaptcha->send($recaptchaResponse, $userIp);

        if (!$status->success):
            $response = [
                'type'       => 'WARNING',
                'statusCode' => 400,
                'title'      => 'Falhou',
                'message'    => 'Favor, avalie o recaptcha.',
                'data'       => [
                    'error' => ''
                ]
            ];
            if ($this->request->isAJAX()):
                session()->remove('referrer');
                return $this->getResponse($response, $response['statusCode']);
            endif;

            return redirect()->to('/admin')->with('response', $response);
        endif;

        $AdminModel = new \App\Models\AdminModel();

        $resultAdmin = $AdminModel->authenticate($this->request->getPost())->first();

        if (empty($resultAdmin)):

            $response = [
                'type'       => 'WARNING',
                'statusCode' => 400,
                'title'      => 'Falhou',
                'message'    => 'Não foi possível realizar o login.<br> E-mail ou senha estão incorretos.',
                'data'       => [
                    'error' => $AdminModel->errors()
                ]
            ];

        else:
            $this->setUserSession($resultAdmin);
            $response = [
                'type'       => 'SUCCESS',
                'statusCode' => 200,
                'title'      => 'Sucesso',
                'message'    => 'Você está logado!',
                'data'       => []
            ];
        endif;

        if ($this->request->isAJAX()):
            session()->remove('referrer');
            return $this->getResponse($response, $response['statusCode']);
        endif;

        if (session()->has('referrer') && $response['statusCode'] == '200'):
            $redirect = session()->get('referrer');
            session()->remove('referrer');
            return redirect()->to($redirect);
        endif;

        return redirect()->to('/admin')->with('response', $response);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}