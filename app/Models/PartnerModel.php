<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of PartnerModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class PartnerModel extends Model
{
    protected $table          = 'Partner';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'name',
        'content',
        'link',
        'image',
        'imageMobile',
        'rowOrder',
        'clicks',
        'status',
    ];
    protected $returnType     = \App\Entities\Partner::class;
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $createdField   = 'createdAt';
    protected $updatedField   = 'updatedAt';
    protected $deletedField   = 'deletedAt';

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
            $row = $r;

            $row['image'] = '<img src="'.imageExists($r['image']).'" class="img-fluid img-thumbnail shadow">';
            $row['menu']  = '<a href="/admin/partner/edit/'.$r['id'].'" class="btn btn-warning btn-sm m-1" title="Edtiar registro">';
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

    function saveSortable($data = [])
    {

        $partner = [];
        $order   = 0;
        foreach ($data as $dj):
            $partner[] = [
                'id'       => $dj['id'],
                'parentId' => (!empty($dj['parent']) && $dj['parent'] != "#") ? $dj['parent']
                    : null,
                'rowOrder' => $order++,
            ];

        endforeach;
        return $this->updateBatch($partner, 'id');
    }
}