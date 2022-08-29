<?php

namespace App\Controllers\Admin;

/**
 * Description of WebSettingController
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class WebSettingController extends \App\Controllers\BaseController
{
    public $module = 'Definições';

    public function index()
    {
        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Configurações gerais do site';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['web_setting'] = getSettings('web_setting', true);
        $data['action']      = '/admin/web-settings/save';

        return $this->viewAdmin($data['page_controller'].'/index', $data);
    }

    public function save()
    {

        $post = $this->request->getPost();
        unset($post[csrf_token()]);

        $Model = new \App\Models\SettingsModel();
        $save  = $Model->updateWebSettings($post);

        if ($save === false):

            $message = (is_array($Model->errors())) ? "<br><hr>".implode('<br><hr>',
                    $Model->errors()) : "";

            $response = [
                'type'       => 'WARNING',
                'title'      => 'Falhou',
                'message'    => 'Não foi possível salvar suas informações.'.$message,
                'statusCode' => 400,
                'error'      => true,
                'data'       => []
            ];

        else:
            $response = [
                'type'       => 'SUCCESS',
                'title'      => 'Sucesso',
                'statusCode' => 200,
                'message'    => 'Informações salvas com sucesso!',
                'error'      => false,
                'data'       => []
            ];
        endif;

        if ($this->request->isAJAX()):
            return $this->getResponse($response, $response['statusCode']);
        endif;

        return redirect()->to('/admin/web-settings')->with('response', $response);
    }
}