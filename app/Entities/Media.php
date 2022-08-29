<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Media
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Media extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $title;
    protected $name;
    protected $extension;
    protected $type;
    protected $subDirectory;
    protected $size;
    protected $createdAt;
    protected $updatedAt;
    protected $deletedAt;

    public function getDates()
    {
        return $this->dates;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSubDirectory()
    {
        return $this->subDirectory;
    }

    public function getSize()
    {
        return $this->size;
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

    public function setDates($dates): void
    {
        $this->dates = $dates;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setSubDirectory($subDirectory): void
    {
        $this->subDirectory = $subDirectory;
    }

    public function setSize($size): void
    {
        $this->size = $size;
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