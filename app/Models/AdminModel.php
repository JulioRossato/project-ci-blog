<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Description of AdminModel
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class AdminModel extends Model
{
    protected $table              = 'Admin';
    protected $primaryKey         = 'id';
    protected $allowedFields      = [
        'email',
        'password',
        'firstName',
        'lastName'
    ];
    protected $returnType         = \App\Entities\Admin::class;
    protected $useTimestamps      = true;
    protected $useSoftDeletes     = true;
    protected $createdField       = 'createdAt';
    protected $updatedField       = 'updatedAt';
    protected $deletedField       = 'deletedAt';
    protected $validationRules    = [
        'firstName'       => ['label' => 'Primeiro Nome', 'rules' => 'required|max_length[255]'],
        'lastName'        => ['label' => 'Último Nome', 'rules' => 'required|max_length[255]'],
        'email'           => ['label' => 'E-mail', 'rules' => 'required|valid_email|is_unique[client.email,id,{id}]'],
        'password'        => ['label' => 'Senha', 'rules' => 'required|max_length[255]'],
        'passwordConfirm' => ['label' => 'Confirma Senha', 'rules' => 'if_exist|matches[password]'],
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Este E-mail já foi cadastrado, favor escolha outro.'
        ]
    ];

    public function authenticate($data)
    {
        $Admin = new \App\Entities\Admin($data);
        $find  = array(
            'email'    => $Admin->getEmail(),
            'password' => $Admin->getPassword(),
        );
        $this->where($find);
        return $this->asArray();
    }
}