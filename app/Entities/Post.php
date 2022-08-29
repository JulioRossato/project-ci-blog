<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Post
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Post extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $title;
    protected $shortDescription;
    protected $content;
    protected $categoryId;
    protected $tags;
    protected $type;
    protected $sensibleContent;
    protected $videoType;
    protected $video;
    protected $image;
    protected $gallery;
    protected $localization;
    protected $author;
    protected $slug;
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSensibleContent()
    {
        return $this->sensibleContent;
    }

    public function getVideoType()
    {
        return $this->videoType;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getGallery()
    {
        return $this->gallery;
    }

    public function getLocalization()
    {
        return $this->localization;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getSlug()
    {
        return $this->slug;
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

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setShortDescription($shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function setTags($tags): void
    {
        $this->tags = $tags;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function setSensibleContent($sensibleContent): void
    {
        $this->sensibleContent = $sensibleContent;
    }

    public function setVideoType($videoType): void
    {
        $this->videoType = $videoType;
    }

    public function setVideo($video): void
    {
        $this->video = $video;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setGallery($gallery): void
    {
        $this->gallery = $gallery;
    }

    public function setLocalization($localization): void
    {
        $this->localization = $localization;
    }

    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
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