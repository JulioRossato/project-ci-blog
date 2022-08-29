<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of ContactModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class ContactModel extends Model
{
    protected $table          = 'Contact';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'name',
        'phone',
        'email',
        'subject',
        'message',
        'ip',
        'log',
        'status',
    ];
    protected $returnType     = \App\Entities\Contact::class;
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

    function getContact($where = [])
    {
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
            $icon  = '<i class="fa-solid fa-eye-slash"></i>';
            $class = 'warning';

            if ($r['status'] == 'visualized'):
                $icon  = '<i class="fa-solid fa-eye"></i>';
                $class = 'light';
            endif;

            $row         = esc($r);
            $row['menu'] = '<a href="/admin/contact/view/'.$r['id'].'" class="btn btn-'.$class.' btn-sm m-1" title="Visualizar mensagem">';
            $row['menu'] .= $icon;
            $row['menu'] .= '</a>';
            $row['menu'] .= '<button type="button" class="remove btn btn-danger btn-sm m-1" value="'.$row['id'].'" title="Remover">';
            $row['menu'] .= '<i class="fa fa-trash"></i>';
            $row['menu'] .= '</button>';

            $rows[] = $row;
        }

        $return['rows'] = $rows;

        return $return;
    }
}