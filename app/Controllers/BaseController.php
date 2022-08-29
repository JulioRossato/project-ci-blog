<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['function', 'url', 'form'];

    /**
     * Get config default
     */
    protected $settings;
    protected $recaptcha;
    protected $csrf;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request,
                                   ResponseInterface $response,
                                   LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // E.g.: $this->session = \Config\Services::session();
        $this->recaptcha = new \App\Libraries\Recaptcha();

        $this->csrf['csrf_header'] = csrf_header();
        $this->csrf['csrf_token']  = csrf_token();
        $this->csrf['csrf_hash']   = csrf_hash();
    }

    protected function viewAdmin($path_view = null, $data = [], $extra = null)
    {
        # =================================
        # Token CSRF
        # =================================
        $data['csrf_header'] = $this->csrf['csrf_header'];
        $data['csrf_token']  = $this->csrf['csrf_token'];
        $data['csrf_hash']   = $this->csrf['csrf_hash'];

        # =================================
        # Config Defaul
        # =================================
        $data['web_title'] = sprintf('%s | '.SITE_TITLE, $data['page_title']);
        $data['web_brand'] = SITE_TITLE;
        $data['admin']     = session()->get('admin');
        $data['contact']   = (new \App\Models\ContactModel)->where('statusCode',
                '3')->countAllResults();

        $render = '';
        $render .= view('Admin/template/header', $data);
        $render .= view('Admin/template/navbar');
        $render .= view('Admin/template/aside');
        $render .= view("Admin/".$path_view);
        $render .= view('Admin/template/footer');
        return $render;
    }

    protected function viewSingle($path_view = null, $data = [], $extra = null)
    {
        # =================================
        # Token CSRF
        # =================================
        $data['csrf_header'] = $this->csrf['csrf_header'];
        $data['csrf_token']  = $this->csrf['csrf_token'];
        $data['csrf_hash']   = $this->csrf['csrf_hash'];

        # =================================
        # Config Defaul
        # =================================
        $data['web_title'] = sprintf('%s | '.SITE_TITLE, $data['page_title']);
        $data['web_brand'] = SITE_TITLE;

        $render = '';
        $render .= view($path_view, $data);
        return $render;
    }

    public function getResponse(array $responseBody,
                                int $code = ResponseInterface::HTTP_OK)
    {
        $responseBody['csrf_header'] = $this->csrf['csrf_header'];
        $responseBody['csrf_token']  = $this->csrf['csrf_token'];
        $responseBody['csrf_hash']   = $this->csrf['csrf_hash'];
        $responseBody['message']     = (!empty($responseBody['message'])) ? $responseBody['message']
                : '';

        return $this
                ->response
                ->setStatusCode($code, $responseBody['message'])
                ->setJSON($responseBody);
    }
}