<?php

namespace App\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Rarity
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
     * @var string
     */
    protected $code;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $cards;

    /**
     * Constructor method initializing the collections.
     */
    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return \App\SiteBundle\Rarity
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @param string $code
     * @return \App\SiteBundle\Rarity
     */
    public function setCode($code)
    {
        $this->code = (string) $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}