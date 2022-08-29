<?php

namespace App\Controllers\Admin;

/**
 * Description of PostController
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class PostController extends \App\Controllers\BaseController
{
    public $module = 'Postagem';

    public function index()
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Artigos Publicados';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['action_result'] = '/admin/post/dataresult';
        $data['page_list']     = [];

        return $this->viewAdmin($data['page_controller'].'/index', $data);
    }

    public function add()
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Adicionar Artigo';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['action']        = base_url('/admin/post/save');
        $data['category_list'] = (new \App\Models\CategoryModel)->formDropdown();
        $data['page_list']     = (new \App\Models\PostModel)->getFields();

        return $this->viewAdmin($data['page_controller'].'/form', $data);
    }

    public function edit($id = null)
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Editar artigo';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================

        $data['action'] = base_url('/admin/post/save');

        $find = (new \App\Models\PostModel)->where(['id' => $id])->asArray()->first();

        if (!$find):
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        endif;

        $data['category_list'] = (new \App\Models\CategoryModel)->formDropdown();

        $data['page_list'] = $find;

        return $this->viewAdmin($data['page_controller'].'/form', $data);
    }

    public function save()
    {
        $Controller = (new \ReflectionClass(__CLASS__))->getShortName();

        $post  = $this->request->getPost();
        $Model = new \App\Models\PostModel();
        $save  = $Model->save($post);

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

        return redirect()->to('/Admin/'.$Controller)->with('response', $response);
    }

    public function dataResult()
    {
        $Model = new \App\Models\PostModel();

        $search = $this->request->getGet('search') ?? '';
        $limit  = $this->request->getGet('limit') ?? 0;
        $offset = $this->request->getGet('offset') ?? 0;
        $sort   = $this->request->getGet('sord') ?? 'id';
        $order  = $this->request->getGet('order') ?? 'desc';

        $dataResult = $Model->dataResult($search, $limit, $offset, $sort, $order);

        $response = [
            'type'       => 'SUCCESS',
            'title'      => 'Sucesso',
            'message'    => 'Dados filtrados com sucesso',
            'statusCode' => 200,
            'error'      => false,
            'data'       =>
            [
                'total' => $dataResult['total'],
                'rows'  => $dataResult['rows']
            ]
        ];

        return $this
                ->response
                ->setStatusCode($response['statusCode'], $response['message'])
                ->setJSON($response['data']);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');

        if ($this->request->getMethod() != 'post' || is_null($id)):
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        endif;

        $Model  = (new \App\Models\PostModel());
        $delete = $Model->delete($id);

        if ($delete === false):

            $message = (is_array($Model->errors())) ? "<br><hr>".implode('<br><hr>',
                    $Model->errors()) : "";

            $response = [
                'type'       => 'WARNING',
                'title'      => 'Falhou',
                'message'    => 'Não foi possível excluir registro.'.$message,
                'statusCode' => 400,
                'error'      => true,
                'data'       => []
            ];

        else:
            $response = [
                'type'       => 'SUCCESS',
                'title'      => 'Sucesso',
                'message'    => 'Arquivos enviados com sucesso.',
                'statusCode' => 200,
                'error'      => false,
                'data'       => []
            ];
        endif;

        if ($this->request->isAJAX()):
            return $this->getResponse($response, $response['statusCode']);
        endif;

        return redirect()->to('/admin/post')->with('response', $response);
    }
}