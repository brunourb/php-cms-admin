<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu", indexes={@ORM\Index(name="menu_menu", columns={"menu_id"})})
 * @ORM\Entity
 */
class Menu extends AbstractEntity
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
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
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
     * @var ArrayCollection|Menu[]
     *
     * @ORM\OneToMany(targetEntity="Menu", mappedBy="menu")
     */
    private $menus;

    /**
     * @var ArrayCollection|Page[]
     *
     * @ORM\OneToMany(targetEntity="Page", mappedBy="menu")
     */
    private $pages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Menu
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Menu
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
     * @return Menu
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
     * @return Menu[]|ArrayCollection
     */
    public function getMenus() {
        return $this->menus;
    }

    /**
     * @param Menu[]|ArrayCollection $menus
     */
    public function setMenus($menus) {
        $this->menus = $menus;
    }

    /**
     * @return Page[]|ArrayCollection
     */
    public function getPages() {
        return $this->pages;
    }

    /**
     * @param Page[]|ArrayCollection $pages
     */
    public function setPages($pages) {
        $this->pages = $pages;
    }
}
