<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PublicityModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class PublicityModel extends Model
{
    protected $table              = 'Publicity';
    protected $primaryKey         = 'id';
    protected $allowedFields      = [
        'title',
        'link',
        'image',
        'dimensions',
        'status',
    ];
    protected $returnType         = \App\Entities\Publicity::class;
    protected $useTimestamps      = true;
    protected $useSoftDeletes     = true;
    protected $createdField       = 'createdAt';
    protected $updatedField       = 'updatedAt';
    protected $deletedField       = 'deletedAt';
    protected $validationRules    = [
//        'title'            => ['label' => 'Título', 'rules' => 'required|max_length[255]'],
    ];
    protected $validationMessages = [];

    function save($data): bool
    {

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

            $row = esc($r);

            $row['image'] = '<img src="'.imageExists($r['image']).'" class="img-fluid img-thumbnail shadow">';
            $row['menu']  = '<a href="/admin/publicity/edit/'.$r['id'].'" class="btn btn-warning btn-sm m-1" title="Edtiar registro">';
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