<?php

namespace App\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Artist
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $count = 0;

    /**
     * Constructor method initializing the collections.
     */
    public function __construct()
    {
    }

    /**
     * @param string $name
     * @return \App\SiteBundle\Artist
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @param integer $count
     * @return Artist
     */
    public function setCount($count)
    {
        $this->count = (int) $count;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}