<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_init", type="date", nullable=true)
     */
    private $dateInit;

    /**
     * @var integer
     *
     * @ORM\Column(name="date_end", type="integer", nullable=true)
     */
    private $dateEnd;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var ArrayCollection|Hotel[]
     *
     * @ORM\OneToMany(targetEntity="Hotel", mappedBy="tariff")
     */
    private $hotels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hotels = new ArrayCollection();
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
     * @return ArrayCollection|Hotel[]
     */
    public function getHotels() {
        return $this->hotels;
    }

    /**
     * @param ArrayCollection|Hotel[] $hotels
     */
    public function setHotels($hotels) {
        $this->hotels = $hotels;
    }
}
