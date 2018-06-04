<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TariffValues
 *
 * @ORM\Table(name="tariff_values", indexes={@ORM\Index(name="room_values_tariff", columns={"tariff_id"}), @ORM\Index(name="tariff_values_hotel", columns={"hotel_id"})})
 * @ORM\Entity
 */
class TariffValues
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
     * @ORM\Column(name="kind_of_host", type="string", nullable=false)
     */
    private $kindOfHost;

    /**
     * @var string
     *
     * @ORM\Column(name="kind_of_room", type="string", nullable=false)
     */
    private $kindOfRoom;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=9, scale=2, nullable=false)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="breakfast", type="boolean", nullable=true)
     */
    private $breakfast;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lunch", type="boolean", nullable=true)
     */
    private $lunch;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dinner", type="boolean", nullable=true)
     */
    private $dinner;

    /**
     * @var \App\Entity\Tariff
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tariff")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tariff_id", referencedColumnName="id")
     * })
     */
    private $tariff;

    /**
     * @var \App\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     * })
     */
    private $hotel;

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
     * Set kindOfHost
     *
     * @param string $kindOfHost
     *
     * @return TariffValues
     */
    public function setKindOfHost($kindOfHost)
    {
        $this->kindOfHost = $kindOfHost;

        return $this;
    }

    /**
     * Get kindOfHost
     *
     * @return string
     */
    public function getKindOfHost()
    {
        return $this->kindOfHost;
    }

    /**
     * Set kindOfRoom
     *
     * @param string $kindOfRoom
     *
     * @return TariffValues
     */
    public function setKindOfRoom($kindOfRoom)
    {
        $this->kindOfRoom = $kindOfRoom;

        return $this;
    }

    /**
     * Get kindOfRoom
     *
     * @return string
     */
    public function getKindOfRoom()
    {
        return $this->kindOfRoom;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return TariffValues
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set breakfast
     *
     * @param boolean $breakfast
     *
     * @return TariffValues
     */
    public function setBreakfast($breakfast)
    {
        $this->breakfast = $breakfast;

        return $this;
    }

    /**
     * Get breakfast
     *
     * @return boolean
     */
    public function getBreakfast()
    {
        return $this->breakfast;
    }

    /**
     * Set lunch
     *
     * @param boolean $lunch
     *
     * @return TariffValues
     */
    public function setLunch($lunch)
    {
        $this->lunch = $lunch;

        return $this;
    }

    /**
     * Get lunch
     *
     * @return boolean
     */
    public function getLunch()
    {
        return $this->lunch;
    }

    /**
     * Set dinner
     *
     * @param boolean $dinner
     *
     * @return TariffValues
     */
    public function setDinner($dinner)
    {
        $this->dinner = $dinner;

        return $this;
    }

    /**
     * Get dinner
     *
     * @return boolean
     */
    public function getDinner()
    {
        return $this->dinner;
    }

    /**
     * Set tariff
     *
     * @param \App\Entity\Tariff $tariff
     *
     * @return TariffValues
     */
    public function setTariff(\App\Entity\Tariff $tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return \App\Entity\Tariff
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * Set hotel
     *
     * @param \App\Entity\Hotel $hotel
     *
     * @return TariffValues
     */
    public function setHotel(\App\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * Get hotel
     *
     * @return \App\Entity\Hotel
     */
    public function getHotel()
    {
        return $this->hotel;
    }
}
