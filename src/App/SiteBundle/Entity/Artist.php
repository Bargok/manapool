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
    protected $cardCount = 0;

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
     * @param integer $cardCount
     * @return Artist
     */
    public function setCardCount($cardCount)
    {
        $this->cardCount = (int) $cardCount;
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
    public function getCardCount()
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