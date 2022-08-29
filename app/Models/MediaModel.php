<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of MediaModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class MediaModel extends Model
{
    protected $table          = 'Media';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'title',
        'name',
        'extension',
        'type',
        'subDirectory',
        'size'
    ];
    protected $returnType     = \App\Entities\Media::class;
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $createdField   = 'createdAt';
    protected $updatedField   = 'updatedAt';
    protected $deletedField   = 'deletedAt';

    function save($data): bool
    {
        return parent::save($data);
    }

    function dataResult(string $search, int $limit, int $offset, string $sort,
                        string $order, string $type = null)
    {

        if (!empty($search)) :
            $search = escape_array($search);
            foreach ($this->allowedFields as $fields) :
                $this->orLike($fields, $search);
            endforeach;
        endif;

        if (!empty($type)) :
            $this->orLike('type', $type);
        endif;

        $return['total'] = $this->countAllResults(false);

        $dbResult = $this->orderBy($sort, $order)->asArray()->findAll($limit,
            $offset);

        $rows = [];

        foreach ($dbResult as $r) {
            $row         = $r;
            $row['link'] = base_url($row['subDirectory'].$row['name']);

            $filePath = "/".$row['subDirectory'].$row['name'];

            $icon = findMediaType($row['extension']);

            if ($icon[0] == 'image'):
                $fileView = imageExists($filePath);
            else:
                $fileView = imageExists($icon[1]);
            endif;

            $row['image'] = '<img src="'.$fileView.'" class="img-fluid img-thumbnail shadow" style="max-width:80px;">';
            $row['menu']  = '<button type="button" class="copy btn btn-primary btn-sm m-1" title="Copiar Link">';
            $row['menu']  .= '<i class="fa-solid fa-copy"></i>';
            $row['menu']  .= '</button>';
            $row['menu']  .= '<button type="button" class="remove delete-media btn btn-danger btn-sm m-1" value="'.$row['id'].'" title="Remover">';
            $row['menu']  .= '<i class="fa fa-trash"></i>';
            $row['menu']  .= '</button>';

            $rows[] = $row;
        }

        $return['rows'] = $rows;

        return $return;
    }
}