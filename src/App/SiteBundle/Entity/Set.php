<?php

namespace App\SiteBundle\Entity;

class Set
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
    protected $slug;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $synchronized;

    /**
     * @var \App\SiteBundle\Block
     */
    protected $block;

    /**
     * @var \App\SiteBundle\Type
     */
    protected $type;

    /**
     * @var boolean
     */
    protected $promo;

    /**
     * @param boolean $promo
     * @var \App\SiteBundle\Set
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
        return $this;
    }

    /**
     * @param string $name
     * @return \App\SiteBundle\Set
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @param string $slug
     * @return \App\SiteBundle\Set
     */
    public function setSlug($slug)
    {
        $this->slug = (string) $slug;
        return $this;
    }

    /**
     * @param string $code
     * @return \App\SiteBundle\Set
     */
    public function setCode($code)
    {
        $this->code = (string) $code;
        return $this;
    }

    /**
     * @param integer $count
     * @return \App\SiteBundle\Set
     */
    public function setCount($count)
    {
        $this->count = (int) $count;
        return $this;
    }

    /**
     * @param \DateTime $date
     * @return \App\SiteBundle\Set
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param \DateTime $synchronized
     * @return \App\SiteBundle\Set
     */
    public function setSynchronized(\DateTime $synchronized)
    {
        $this->synchronized = $synchronized;
        return $this;
    }

    /**
     * @param Block $block
     * @return \App\SiteBundle\Set
     */
    public function setBlock(Block $block)
    {
        $this->block = $block;
        return $this;
    }

    /**
     * @param Type $type
     * @return \App\SiteBundle\Set
     */
    public function setType(Type $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return \DateTime
     */
    public function getSynchronized()
    {
        return $this->synchronized;
    }

    /**
     * @return \App\SiteBundle\Block
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @return \App\SiteBundle\Type
     */
    public function getType()
    {
        return $this->type;
    }

    public function getPromo()
    {
        return $this->promo;
    }
}


