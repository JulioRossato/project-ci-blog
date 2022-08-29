<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * Description of Contact
 *
 * @author Júlio Rossato <WWW.JULIOROSSATO.COM.BR>
 */
class Contact extends Entity
{
    protected $dates = ['createdAt', 'updatedAt', 'deletedAt'];
    protected $id;
    protected $name;
    protected $phone;
    protected $email;
    protected $subject;
    protected $message;
    protected $ip;
    protected $log;
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

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getLog()
    {
        return $this->log;
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

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    public function setLog($log): void
    {
        $this->log = $log;
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