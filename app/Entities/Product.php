<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Product
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Product extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $name;
    protected $shortDescription;
    protected $productIdentity;
    protected $tags;
    protected $tax;
    protected $indicator;
    protected $madeIn;
    protected $minimumOrderQuantity;
    protected $totalAllowedQuantity;
    protected $quantityStepSize;
    protected $warrantyPeriod;
    protected $guaranteePeriod;
    protected $deliverableType;
    protected $deliverableZipCodes;
    protected $ProductCategoryId;
    protected $videoType;
    protected $video;
    protected $rowOrder;
    protected $type;
    protected $stockType;
    protected $slug;
    protected $codAllowed;
    protected $isPricesInclusiveTax;
    protected $isReturnable;
    protected $isCancelable;
    protected $cancelableTill;
    protected $image;
    protected $otherImages;
    protected $sku;
    protected $stock;
    protected $availability;
    protected $rating;
    protected $noOfRatings;
    protected $description;
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

    public function getName()
    {
        return $this->name;
    }

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function getProductIdentity()
    {
        return $this->productIdentity;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function getIndicator()
    {
        return $this->indicator;
    }

    public function getMadeIn()
    {
        return $this->madeIn;
    }

    public function getMinimumOrderQuantity()
    {
        return $this->minimumOrderQuantity;
    }

    public function getTotalAllowedQuantity()
    {
        return $this->totalAllowedQuantity;
    }

    public function getQuantityStepSize()
    {
        return $this->quantityStepSize;
    }

    public function getWarrantyPeriod()
    {
        return $this->warrantyPeriod;
    }

    public function getGuaranteePeriod()
    {
        return $this->guaranteePeriod;
    }

    public function getDeliverableType()
    {
        return $this->deliverableType;
    }

    public function getDeliverableZipCodes()
    {
        return $this->deliverableZipCodes;
    }

    public function getProductCategoryId()
    {
        return $this->ProductCategoryId;
    }

    public function getVideoType()
    {
        return $this->videoType;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function getRowOrder()
    {
        return $this->rowOrder;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getStockType()
    {
        return $this->stockType;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getCodAllowed()
    {
        return $this->codAllowed;
    }

    public function getIsPricesInclusiveTax()
    {
        return $this->isPricesInclusiveTax;
    }

    public function getIsReturnable()
    {
        return $this->isReturnable;
    }

    public function getIsCancelable()
    {
        return $this->isCancelable;
    }

    public function getCancelableTill()
    {
        return $this->cancelableTill;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getOtherImages()
    {
        return $this->otherImages;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getAvailability()
    {
        return $this->availability;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function getNoOfRatings()
    {
        return $this->noOfRatings;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setShortDescription($shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function setProductIdentity($productIdentity): void
    {
        $this->productIdentity = $productIdentity;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    public function setTax($tax): void
    {
        $this->tax = $tax;
    }

    public function setIndicator($indicator): void
    {
        $this->indicator = $indicator;
    }

    public function setMadeIn($madeIn): void
    {
        $this->madeIn = $madeIn;
    }

    public function setMinimumOrderQuantity($minimumOrderQuantity): void
    {
        $this->minimumOrderQuantity = $minimumOrderQuantity;
    }

    public function setTotalAllowedQuantity($totalAllowedQuantity): void
    {
        $this->totalAllowedQuantity = $totalAllowedQuantity;
    }

    public function setQuantityStepSize($quantityStepSize): void
    {
        $this->quantityStepSize = $quantityStepSize;
    }

    public function setWarrantyPeriod($warrantyPeriod): void
    {
        $this->warrantyPeriod = $warrantyPeriod;
    }

    public function setGuaranteePeriod($guaranteePeriod): void
    {
        $this->guaranteePeriod = $guaranteePeriod;
    }

    public function setDeliverableType($deliverableType): void
    {
        $this->deliverableType = $deliverableType;
    }

    public function setDeliverableZipCodes($deliverableZipCodes): void
    {
        $this->deliverableZipCodes = $deliverableZipCodes;
    }

    public function setProductCategoryId($ProductCategoryId): void
    {
        $this->ProductCategoryId = $ProductCategoryId;
    }

    public function setVideoType($videoType): void
    {
        $this->videoType = $videoType;
    }

    public function setVideo($video): void
    {
        $this->video = $video;
    }

    public function setRowOrder($rowOrder): void
    {
        $this->rowOrder = $rowOrder;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setStockType($stockType): void
    {
        $this->stockType = $stockType;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function setCodAllowed($codAllowed): void
    {
        $this->codAllowed = $codAllowed;
    }

    public function setIsPricesInclusiveTax($isPricesInclusiveTax): void
    {
        $this->isPricesInclusiveTax = $isPricesInclusiveTax;
    }

    public function setIsReturnable($isReturnable): void
    {
        $this->isReturnable = $isReturnable;
    }

    public function setIsCancelable($isCancelable): void
    {
        $this->isCancelable = $isCancelable;
    }

    public function setCancelableTill($cancelableTill): void
    {
        $this->cancelableTill = $cancelableTill;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setOtherImages($otherImages): void
    {
        $this->otherImages = $otherImages;
    }

    public function setSku($sku): void
    {
        $this->sku = $sku;
    }

    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    public function setAvailability($availability): void
    {
        $this->availability = $availability;
    }

    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    public function setNoOfRatings($noOfRatings): void
    {
        $this->noOfRatings = $noOfRatings;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
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