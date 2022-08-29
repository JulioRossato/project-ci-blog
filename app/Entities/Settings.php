<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Settings
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Settings extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $variable;
    protected $value;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;

    public function getId()
    {
        return $this->id;
    }

    public function getVariable()
    {
        return $this->variable;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setVariable($variable): void
    {
        $this->variable = $variable;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setDeletedAt($deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}