<?php

namespace App\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class CardVersion
{
    protected $id;
    protected $cardId;
    protected $setId;
    protected $card;
    protected $parts;
    protected $set;

    public function __construct()
    {
        $this->parts = new ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param Set $set
     * @return CardVersion
     */
    public function setSet(Set $set)
    {
        $this->set = $set;
        return $this;
    }

    public function setCard(Card $card)
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function getSet()
    {
        return $this->set;
    }
}