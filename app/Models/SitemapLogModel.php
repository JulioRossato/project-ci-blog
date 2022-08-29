<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of SitemapLogModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class SitemapLogModel extends Model
{
    protected $table          = 'SitemapLog';
    protected $primaryKey     = 'id';
    protected $allowedFields  = [
        'description',
        'url',
        'log',
    ];
    protected $returnType     = \App\Entities\SitemapLog::class;
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $createdField   = 'createdAt';
    protected $updatedField   = 'updatedAt';
    protected $deletedField   = 'deletedAt';

}