<?php

namespace App\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Block
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $sets;

    /**
     * Constructor method initializing the collections.
     */
    public function __construct()
    {
        $this->sets = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return \App\SiteBundle\Block
     */
    public function setName($name)
    {
        $this->name = (string) $name;
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
    public function getId()
    {
        return $this->id;
    }
}