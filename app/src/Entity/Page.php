<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page", indexes={@ORM\Index(name="page_menu", columns={"menu_id"})})
 * @ORM\Entity
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_clean", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nameClean;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

    /**
     * @var \App\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $menu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Tag", mappedBy="page")
     */
    private $tags;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\PageDetails", mappedBy="page")
     */
    private $details;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Banner", mappedBy="page")
     */
    private $banners;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->details = new \Doctrine\Common\Collections\ArrayCollection();
        $this->banners = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Page
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nameClean
     *
     * @param string $nameClean
     *
     * @return Page
     */
    public function setNameClean($nameClean)
    {
        $this->nameClean = $nameClean;

        return $this;
    }

    /**
     * Get nameClean
     *
     * @return string
     */
    public function getNameClean()
    {
        return $this->nameClean;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Page
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set menu
     *
     * @param \App\Entity\Menu $menu
     *
     * @return Page
     */
    public function setMenu(\App\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \App\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add tag
     *
     * @param \App\Entity\Tag $tag
     *
     * @return Page
     */
    public function addTag(\App\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \App\Entity\Tag $tag
     */
    public function removeTag(\App\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add detail
     *
     * @param \App\Entity\PageDetails $detail
     *
     * @return Page
     */
    public function addDetail(\App\Entity\PageDetails $detail)
    {
        $this->details[] = $detail;

        return $this;
    }

    /**
     * Remove detail
     *
     * @param \App\Entity\PageDetails $detail
     */
    public function removeDetail(\App\Entity\PageDetails $detail)
    {
        $this->details->removeElement($detail);
    }

    /**
     * Get details
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Add banner
     *
     * @param \App\Entity\Banner $banner
     *
     * @return Page
     */
    public function addBanner(\App\Entity\Banner $banner)
    {
        $this->banners[] = $banner;

        return $this;
    }

    /**
     * Remove banner
     *
     * @param \App\Entity\Banner $banner
     */
    public function removeBanner(\App\Entity\Banner $banner)
    {
        $this->banners->removeElement($banner);
    }

    /**
     * Get banners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBanners()
    {
        return $this->banners;
    }
}

