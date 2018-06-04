<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu", indexes={@ORM\Index(name="menu_idx", columns={"description"}), @ORM\Index(name="menu_menu", columns={"menu_id"})})
 * @ORM\Entity
 */
class Menu
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_created", type="datetime", nullable=false)
     */
    private $dataCreated = 'CURRENT_TIMESTAMP';

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
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
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
     * Set dataCreated
     *
     * @param \DateTime $dataCreated
     *
     * @return Menu
     */
    public function setDataCreated($dataCreated)
    {
        $this->dataCreated = $dataCreated;

        return $this;
    }

    /**
     * Get dataCreated
     *
     * @return \DateTime
     */
    public function getDataCreated()
    {
        return $this->dataCreated;
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
}
