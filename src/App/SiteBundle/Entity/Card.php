<?php

namespace App\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Card
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

    protected $versions;

    /**
     * Constructor method initializing the collections.
     */
    public function __construct()
    {
        $this->versions = new ArrayCollection();
    }

    /**
     * @param string $name
     * @return \App\SiteBundle\Card
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * @param string $slug
     * @return \App\SiteBundle\Card
     */
    public function setSlug($slug)
    {
        $this->slug = (string) $slug;
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