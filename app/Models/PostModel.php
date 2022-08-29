<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PostModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class PostModel extends Model
{
    protected $table              = 'Post';
    protected $primaryKey         = 'id';
    protected $allowedFields      = [
        'id',
        'title',
        'shortDescription',
        'content',
        'categoryId',
        'tags',
        'type',
        'sensibleContent',
        'videoType',
        'video',
        'image',
        'gallery',
        'localization',
        'author',
        'slug',
        'status',
        'createdAt',
        'updatedAt',
        'deletedAt',
    ];
    protected $returnType         = \App\Entities\Post::class;
    protected $useTimestamps      = true;
    protected $useSoftDeletes     = true;
    protected $createdField       = 'createdAt';
    protected $updatedField       = 'updatedAt';
    protected $deletedField       = 'deletedAt';
    protected $validationRules    = [
        'title'            => ['label' => 'Título', 'rules' => 'required|max_length[255]'],
        'shortDescription' => ['label' => 'Resumo', 'rules' => 'required|max_length[160]'],
        'categoryId'       => ['label' => 'Categoria', 'rules' => 'required|max_length[11]'],
        'type'             => ['label' => 'Tipo', 'rules' => 'required|max_length[11]'],
        'image'            => ['label' => 'Capa', 'rules' => 'required|max_length[255]'],
    ];
    protected $validationMessages = [];

    function save($data): bool
    {
        if (!empty($data['gallery'])):
            $data['gallery'] = json_encode($data['gallery'], JSON_PRETTY_PRINT);
        else:
            $data['gallery'] = "[]";
        endif;

        if (empty($data['videoType'])):
            $data['video'] = null;
        elseif (in_array($data['videoType'], ['self_hosted'])):
            $data['video'] = $data['inputVideo'];
        endif;

        $data['slug'] = createUniqueSlug($data['title'], $this->table, 'slug',
            $this->primaryKey, $data['id']);

        return parent::save($data);
    }

    function getFields($type = "key")
    {
        $fields = [];
        foreach ($this->getFieldNames($this->table) as $field) {

            if ($type == 'key') {
                $fields[$field] = null;
            } else {
                $fields[] = $field;
            }
        }

        return $fields;
    }

    function getPost($where = [])
    {
        $this->select('
            Post.id,
            Post.title,
            Post.shortDescription,
            Post.content,
            Post.image,
            Post.gallery,
            Post.tags,
            Post.categoryId,
            Post.type,
            concat(DATE_FORMAT(Post.createdAt, "%Y/%m/%d/"), Post.slug) slug,
            Post.status,
            Post.localization,
            Post.sensibleContent,
            Post.author,
            Post.videoType,
            Post.video,
            Post.createdAt,
            Post.updatedAt,
            Post.deletedAt,
            Category.name as "categoryName"
            ');
        $this->join('Category', 'Category.id = Post.categoryId', 'left');
        $this->where($where);
        $this->asArray();
        return $this;
    }

    function getList($where = [])
    {
        $where['Post.status'] = 'publish';

        $this->select('
            Post.id,
            Post.title,
            Post.shortDescription,
            Post.content,
            Post.image,
            Post.gallery,
            Post.tags,
            Post.categoryId,
            Post.type,
            concat(DATE_FORMAT(Post.createdAt, "%Y/%m/%d/"), Post.slug) slug,
            Post.status,
            Post.localization,
            Post.sensibleContent,
            Post.author,
            Post.videoType,
            Post.video,
            Post.createdAt,
            Post.updatedAt,
            Post.deletedAt,
            Category.name as "categoryName"
            ');
        $this->join('Category', 'Category.id = Post.categoryId', 'left');
        $this->where($where);
        $this->asArray();
        return $this;
    }

    function dataResult(string $search, int $limit, int $offset, string $sort,
                        string $order)
    {
        if (!empty($search)) {

            $search = escape_array($search);

            foreach ($this->allowedFields as $fields) {
                $this->orLike($fields, $search);
            }
        }

        $return['total'] = $this->countAllResults(false);

        $dbResult = $this->orderBy($sort, $order)->asArray()->findAll($limit,
            $offset);
        $rows     = [];
        foreach ($dbResult as $r) {
            $row = $r;

            $row['image'] = '<img src="'.postImage($r['image']).'" class="img-fluid img-thumbnail shadow">';
            $row['menu']  = '<a href="/admin/post/edit/'.$r['id'].'" class="btn btn-warning btn-sm m-1" title="Edtiar registro">';
            $row['menu']  .= '<i class="fa-solid fa-edit"></i>';
            $row['menu']  .= '</a>';
            $row['menu']  .= '<button type="button" class="remove btn btn-danger btn-sm m-1" value="'.$row['id'].'" title="Remover">';
            $row['menu']  .= '<i class="fa fa-trash"></i>';
            $row['menu']  .= '</button>';

            $rows[] = $row;
        }

        $return['rows'] = $rows;

        return $return;
    }
}