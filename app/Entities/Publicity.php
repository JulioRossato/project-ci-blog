<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Publicity
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Publicity extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $title;
    protected $image;
    protected $link;
    protected $dimensions;
    protected $status;
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

    public function getImage()
    {
        return $this->image;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getDimensions()
    {
        return $this->dimensions;
    }

    public function getStatus()
    {
        return $this->status;
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

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setLink($link): void
    {
        $this->link = $link;
    }

    public function setDimensions($dimensions): void
    {
        $this->dimensions = $dimensions;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
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