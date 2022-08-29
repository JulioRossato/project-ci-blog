<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of ProductVariants
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class ProductVariants extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $productId;
    protected $attributeValueIds;
    protected $attributeSet;
    protected $price;
    protected $specialPrice;
    protected $sku;
    protected $stock;
    protected $images;
    protected $availability;
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

    public function getProductId()
    {
        return $this->productId;
    }

    public function getAttributeValueIds()
    {
        return $this->attributeValueIds;
    }

    public function getAttributeSet()
    {
        return $this->attributeSet;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getSpecialPrice()
    {
        return $this->specialPrice;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function getAvailability()
    {
        return $this->availability;
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

    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    public function setAttributeValueIds($attributeValueIds): void
    {
        $this->attributeValueIds = $attributeValueIds;
    }

    public function setAttributeSet($attributeSet): void
    {
        $this->attributeSet = $attributeSet;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function setSpecialPrice($specialPrice): void
    {
        $this->specialPrice = $specialPrice;
    }

    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    public function setImages($images): void
    {
        $this->images = $images;
    }

    public function setAvailability($availability): void
    {
        $this->availability = $availability;
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