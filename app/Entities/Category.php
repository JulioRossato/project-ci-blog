<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Category
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Category extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $name;
    protected $parentId;
    protected $slug;
    protected $image;
    protected $imageMobile;
    protected $rowOrder;
    protected $statusCode;
    protected $clicks;
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

    public function getName()
    {
        return $this->name;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getImageMobile()
    {
        return $this->imageMobile;
    }

    public function getRowOrder()
    {
        return $this->rowOrder;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getClicks()
    {
        return $this->clicks;
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

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setParentId($parentId): void
    {
        $this->parentId = $parentId;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setImageMobile($imageMobile): void
    {
        $this->imageMobile = $imageMobile;
    }

    public function setRowOrder($rowOrder): void
    {
        $this->rowOrder = $rowOrder;
    }

    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function setClicks($clicks): void
    {
        $this->clicks = $clicks;
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