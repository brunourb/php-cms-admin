<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="name_clean", type="string", length=50, nullable=true)
     */
    private $nameClean;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var \App\Entity\Menu
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Menu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_id", referencedColumnName="id")
     * })
     */
    private $menu;

    /**
     * @var ArrayCollection|Tag[]
     *
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="page")
     */
    private $tags;

    /**
     * @var ArrayCollection|PageDetails[]
     *
     * @ORM\OneToMany(targetEntity="PageDetails", mappedBy="page")
     */
    private $details;

    /**
     * @var ArrayCollection|Banner[]
     *
     * @ORM\OneToMany(targetEntity="Banner", mappedBy="page")
     */
    private $banners;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->details = new ArrayCollection();
        $this->banners = new ArrayCollection();
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

    public function setId($id){
        $this->id = $id;
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
     * @return Tag[]|ArrayCollection
     */
    public function getTags() {
        return $this->tags;
    }

    /**
     * @param Tag[]|ArrayCollection $tags
     */
    public function setTags($tags) {
        $this->tags = $tags;
    }

    /**
     * @return PageDetails[]|ArrayCollection
     */
    public function getDetails() {
        return $this->details;
    }

    /**
     * @param PageDetails[]|ArrayCollection $details
     */
    public function setDetails($details) {
        $this->details = $details;
    }

    /**
     * @return Banner[]|ArrayCollection
     */
    public function getBanners() {
        return $this->banners;
    }

    /**
     * @param Banner[]|ArrayCollection $banners
     */
    public function setBanners($banners) {
        $this->banners = $banners;
    }

}
