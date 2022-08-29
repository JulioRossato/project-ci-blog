<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of CategoryModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class CategoryModel extends Model
{
    protected $table          = 'Category';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'name',
        'parentId',
        'slug',
        'image',
        'banner',
        'rowOrder',
        'status',
        'clicks'
    ];
    protected $returnType     = \App\Entities\Category::class;
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $createdField   = 'createdAt';
    protected $updatedField   = 'updatedAt';
    protected $deletedField   = 'deletedAt';

    function save($data): bool
    {
        $data['slug'] = createUniqueSlug($data['name'], $this->table, 'slug',
            $this->primaryKey, $data['id']);

        $data['parentId'] = $data['parentId'] == 0 ? null : $data['parentId'];

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

    function getCategory($where = [])
    {
        $this->where($where);
        $this->asArray();
        return $this;
    }

    function formDropdown($where = [])
    {

        $this->where($where);
        $this->asArray();

        $result = [];
        foreach ($this->find() as $r):
            $result[$r['id']] = $r['name'];
        endforeach;

        return $result;
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
            $row          = $r;
            $row['image'] = '<img src="'.imageExists($r['image']).'" class="img-fluid img-thumbnail shadow">';
            $row['menu']  = '<a href="/admin/category/edit/'.$r['id'].'" class="btn btn-warning btn-sm m-1" title="Edtiar registro">';
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

    function dataTree(string $parentId = null, int $limit = 1000,
                      int $offset = 0, string $sort = 'rowOrder',
                      string $order = 'asc')
    {
        if (!empty($parentId) && $parentId != "#"):
            $this->where('parentId', $parentId);
        else:
            $this->where('parentId is null');
        endif;

        $dbResult = $this->orderBy($sort, $order)->asArray()->findAll($limit,
            $offset);

        $rows = [];

        foreach ($dbResult as $r) {
            $row = [
                'id'       => $r['id'],
                'parentId' => $r['parentId'] ?? "#",
                'parent'   => $r['parentId'] ?? "#",
                'type'     => (empty($r['parentId'])) ? 'folder' : "file",
                'text'     => $r['name'],
                'children' => true,
                'state'    => [
                    'opened'   => true,
                    'desabled' => $r['status']
                ],
                'a_attr'   => base_url('admin/category/edit/'.$r['id'])
            ];

            $rows[] = $row;
        }


        return $rows;
    }

    function saveSortable($data = [])
    {

        $category = [];
        $order    = 0;
        foreach ($data as $dj):
            $category[] = [
                'id'       => $dj['id'],
                'parentId' => (!empty($dj['parent']) && $dj['parent'] != "#") ? $dj['parent']
                    : null,
                'rowOrder' => $order++,
            ];

        endforeach;
        return $this->updateBatch($category, 'id');
    }
}