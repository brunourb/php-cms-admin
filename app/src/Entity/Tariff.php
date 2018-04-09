<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tariff
 *
 * @ORM\Table(name="tariff")
 * @ORM\Entity
 */
class Tariff
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
     * @ORM\Column(name="description", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_init", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateInit;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_end", type="integer", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dateEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $enabled;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Hotel", mappedBy="tariff")
     */
    private $hotels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hotels = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Tariff
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
     * Set dateInit
     *
     * @param \DateTime $dateInit
     *
     * @return Tariff
     */
    public function setDateInit($dateInit)
    {
        $this->dateInit = $dateInit;

        return $this;
    }

    /**
     * Get dateInit
     *
     * @return \DateTime
     */
    public function getDateInit()
    {
        return $this->dateInit;
    }

    /**
     * Set dateEnd
     *
     * @param integer $dateEnd
     *
     * @return Tariff
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return integer
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Tariff
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
     * Add hotel
     *
     * @param \App\Entity\Hotel $hotel
     *
     * @return Tariff
     */
    public function addHotel(\App\Entity\Hotel $hotel)
    {
        $this->hotels[] = $hotel;

        return $this;
    }

    /**
     * Remove hotel
     *
     * @param \App\Entity\Hotel $hotel
     */
    public function removeHotel(\App\Entity\Hotel $hotel)
    {
        $this->hotels->removeElement($hotel);
    }

    /**
     * Get hotels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHotels()
    {
        return $this->hotels;
    }
}

