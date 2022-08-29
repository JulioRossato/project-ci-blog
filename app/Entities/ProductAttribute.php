<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of ProductAttribute
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class ProductAttribute extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $productId;
    protected $attributeValueIds;
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

    public function getProductId()
    {
        return $this->productId;
    }

    public function getAttributeValueIds()
    {
        return $this->attributeValueIds;
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

    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    public function setAttributeValueIds($attributeValueIds): void
    {
        $this->attributeValueIds = $attributeValueIds;
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