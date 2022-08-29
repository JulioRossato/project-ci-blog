<?php

namespace App\Controllers\Admin;

/**
 * Description of CategoryController
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class CategoryController extends \App\Controllers\BaseController
{
    public $module = 'Categoria';

    public function index()
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Lista de categorias';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['action_result'] = '/admin/category/dataresult';
        $data['page_list']     = [];

        return $this->viewAdmin($data['page_controller'].'/index', $data);
    }

    public function add()
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Adicionar categoria';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['action']        = base_url('/admin/category/save');
        $data['page_list']     = (new \App\Models\CategoryModel)->getFields();
        $data['category_list'] = (new \App\Models\CategoryModel)->getCategory()->find();

        return $this->viewAdmin($data['page_controller'].'/form', $data);
    }

    public function edit($id = null)
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Editar categoria';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================

        $data['action']        = base_url('/admin/category/save');
        $data['category_list'] = (new \App\Models\CategoryModel)->getCategory()->find();

        $find = (new \App\Models\CategoryModel)->where(['id' => $id])->asArray()->first();

        if (!$find):
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        endif;

        $data['page_list'] = $find;

        return $this->viewAdmin($data['page_controller'].'/form', $data);
    }

    public function save()
    {
        $Controller = (new \ReflectionClass(__CLASS__))->getShortName();

        $post  = $this->request->getPost();
        $Model = new \App\Models\CategoryModel();
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

        return redirect()->to('/admin/category')->with('response', $response);
    }

    public function dataResult()
    {
        $Model = new \App\Models\CategoryModel();

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

        $Model  = (new \App\Models\CategoryModel());
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

        return redirect()->to('/admin/category')->with('response', $response);
    }

    public function saveSortable()
    {

        $dataJson = json_decode($this->request->getPost('dataTree'), true);

        $Model = new \App\Models\CategoryModel();
        $save  = $Model->saveSortable($dataJson);

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

        return redirect()->to('/admin/category')->with('response', $response);
    }

    public function dataTree()
    {
        $Model = new \App\Models\CategoryModel();

        $parentId = $this->request->getGet('parentId') ?? null;

        $dataTree = $Model->dataTree($parentId);

        $response = [
            'type'       => 'SUCCESS',
            'title'      => 'Sucesso',
            'message'    => 'Dados filtrados com sucesso',
            'statusCode' => 200,
            'error'      => false,
            'data'       => [
                'dataTree' => $dataTree
            ]
        ];

        return $this
                ->response
                ->setStatusCode($response['statusCode'], $response['message'])
                ->setJSON($response['data']['dataTree']);
    }
}