<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of AttributeValue
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class AttributeValue extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $attributeId;
    protected $filterable;
    protected $value;
    protected $swatcheType;
    protected $swatcheValue;
    protected $statusCode;
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

    public function getAttributeId()
    {
        return $this->attributeId;
    }

    public function getFilterable()
    {
        return $this->filterable;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSwatcheType()
    {
        return $this->swatcheType;
    }

    public function getSwatcheValue()
    {
        return $this->swatcheValue;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
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

    public function setAttributeId($attributeId): void
    {
        $this->attributeId = $attributeId;
    }

    public function setFilterable($filterable): void
    {
        $this->filterable = $filterable;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function setSwatcheType($swatcheType): void
    {
        $this->swatcheType = $swatcheType;
    }

    public function setSwatcheValue($swatcheValue): void
    {
        $this->swatcheValue = $swatcheValue;
    }

    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
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