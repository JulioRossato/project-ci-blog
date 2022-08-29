<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of SitemapLog
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class SitemapLog extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $description;
    protected $url;
    protected $log;
    protected $createdAt;
    protected $updatedAt;
    protected $deltedAt;

    public function getDates()
    {
        return $this->dates;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getLog()
    {
        return $this->log;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getDeltedAt()
    {
        return $this->deltedAt;
    }

    public function setDates($dates): void
    {
        $this->dates = $dates;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function setLog($log): void
    {
        $this->log = $log;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function setDeltedAt($deltedAt): void
    {
        $this->deltedAt = $deltedAt;
    }
}