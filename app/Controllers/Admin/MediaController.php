<?php

namespace App\Controllers\Admin;

/**
 * Description of MediaController
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class MediaController extends \App\Controllers\BaseController
{
    public $module = 'Mídia';

    public function index()
    {

        # =================================
        # Config Controller
        # =================================

        $data['page_module']     = $this->module;
        $data['page_title']      = 'Galeria de mídia';
        $data['page_controller'] = (new \ReflectionClass(__CLASS__))->getShortName();
        $data['page_method']     = __FUNCTION__;

        # =================================
        $data['action_result'] = '/admin/media/dataresult';

        $data['page_list'] = [];

        return $this->viewAdmin($data['page_controller'].'/index', $data);
    }

    public function save()
    {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '15000');
        ini_set('default_charset', 'utf-8');
        set_time_limit(0);

        $year_month   = date('Y/m');
        $target_path  = FCPATH.MEDIA_PATH.$year_month.'/';
        $subDirectory = MEDIA_PATH.$year_month.'/';

        if (!file_exists($target_path)) {
            mkdir($target_path, 0777, true);
        }

        $ext_in = implode(',', allowedMediaTypes());

        $validationRule = [
            'documents' => [
                'label' => 'Arquivo',
                'rules' => 'uploaded[documents]'
            //    .'|ext_in[documents,'.$ext_in.']'
            ],
        ];

        if (!$this->validate($validationRule)) :
            $response = [
                'type'       => 'WARNING',
                'title'      => 'Falhou',
                'message'    => $this->validator->getError(),
                'statusCode' => 400,
                'error'      => true,
                'data'       => []
            ];
            return $this->getResponse($response, $response['statusCode']);
        endif;

        if ($imagefile = $this->request->getFiles()):
            foreach ($imagefile['documents'] as $img) :
                if ($img->isValid() && !$img->hasMoved()) :

                    $extenstionData = findMediaType($img->getClientExtension());
                    $media_type     = $extenstionData[0];

                    $newName = $img->getRandomName();
                    $img->move($target_path, $newName);

                    postImage($subDirectory.$newName);

                    $imgSave[] = [
                        'title'        => $img->getClientName(),
                        'name'         => $newName,
                        'extension'    => $img->getClientExtension(),
                        'type'         => ($media_type != false) ? $media_type : 'other',
                        'subDirectory' => $subDirectory,
                        'size'         => $img->getSize()
                    ];
                endif;
            endforeach;
        endif;

        if (isset($imgSave) && count($imgSave) > 0) :
            $Model = new \App\Models\MediaModel();
            if ($Model->insertBatch($imgSave)) :
                $response = [
                    'type'       => 'SUCCESS',
                    'title'      => 'Sucesso',
                    'message'    => 'Arquivos enviados com sucesso.',
                    'statusCode' => 200,
                    'error'      => false,
                    'data'       => []
                ];
            endif;
        else:
            $response = [
                'type'       => 'WARNING',
                'title'      => 'Falhou',
                'message'    => 'Não foi possível processar seus arquivos.',
                'statusCode' => 400,
                'error'      => true,
                'data'       => []
            ];
        endif;

        return $this->getResponse($response, $response['statusCode']);
    }

    public function dataResult()
    {

        $Model = new \App\Models\MediaModel();

        $search = $this->request->getGet('search') ?? '';
        $limit  = $this->request->getGet('limit') ?? 0;
        $offset = $this->request->getGet('offset') ?? 0;
        $sort   = $this->request->getGet('sord') ?? 'id';
        $order  = $this->request->getGet('order') ?? 'desc';
        $type   = $this->request->getGet('type') ?? null;

        $dataResult = $Model->dataResult($search, $limit, $offset, $sort,
            $order, $type);

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

        $Model = (new \App\Models\MediaModel());

        $find = $Model->where('id', $id)->asArray()->first();

        if (!$find):
            $response = [
                'type'       => 'WARNING',
                'title'      => 'Falhou',
                'message'    => 'Não foi possível localizar arquivo para exclusão.',
                'statusCode' => 400,
                'error'      => true,
                'data'       => []
            ];
        endif;

        $fileOrigin = FCPATH.$find['subDirectory'].$find['name'];

        $fileTrash = str_replace("/media/", "/media_trash/", $fileOrigin);

        $delete = false;
        if (file_exists($fileOrigin)):

            $pathInfo = pathinfo($fileTrash);

            if (!is_dir($pathInfo['dirname'])):
                mkdir($pathInfo['dirname'], 0777, true);
            endif;

            if (rename($fileOrigin, $fileTrash)):
                $delete = $Model->delete($id);
            endif;
        endif;

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

        return redirect()->to('/admin/Medias')->with('response', $response);
    }
}