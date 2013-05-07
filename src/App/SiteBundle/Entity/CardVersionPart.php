<?php

namespace App\SiteBundle\Entity;


class CardVersionPart
{
    protected $id;
    protected $number;
    protected $text;
    protected $flavor;
    protected $name;
    protected $image;
    protected $version;
    protected $manaCost;
    protected $convertedManaCost;
    protected $types;
    protected $power;
    protected $toughness;
    protected $loyalty;
    protected $rarity;
    protected $artist;

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $text
     * @return CardVersion
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param string $flavor
     * @return CardVersion
     */
    public function setFlavor($flavor)
    {
        $this->flavor = $flavor;
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

    /**
     * @param Artist $artist
     * @return CardVersion
     */
    public function setArtist(Artist $artist)
    {
        $this->artist = $artist;
        return $this;
    }

    /**
     * @param Rarity $rarity
     * @return CardVersion
     */
    public function setRarity(Rarity $rarity)
    {
        $this->rarity = $rarity;
        return $this;
    }

    public function getBackId()
    {
        return $this->backId;
    }


    /**
     * @param string $manaCost
     * @return \App\SiteBundle\Card
     */
    public function setManaCost($manaCost)
    {
        $this->manaCost = $manaCost;
        return $this;
    }

    /**
     * @param string $convertedManaCost
     * @return \App\SiteBundle\Card
     */
    public function setConvertedManaCost($convertedManaCost)
    {
        $this->convertedManaCost = $convertedManaCost;
        return $this;
    }

    /**
     * @param string $types
     * @return \App\SiteBundle\Card
     */
    public function setTypes($types)
    {
        $this->types = (string) $types;
        return $this;
    }

    /**
     * @param string $power
     * @return \App\SiteBundle\Card
     */
    public function setPower($power)
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @param string $toughness
     * @return \App\SiteBundle\Card
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;
        return $this;
    }

    /**
     * @param string $loyalty
     * @return \App\SiteBundle\Card
     */
    public function setLoyalty($loyalty)
    {
        $this->loyalty = $loyalty;
        return $this;
    }

    public function setCard(Card $card)
    {
        $this->card = $card;
        return $this;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }
}