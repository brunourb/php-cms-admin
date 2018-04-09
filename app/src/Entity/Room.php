<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room", indexes={@ORM\Index(name="room_hotel", columns={"hotel_id"})})
 * @ORM\Entity
 */
class Room
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
     * @var integer
     *
     * @ORM\Column(name="description", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $enabled;

    /**
     * @var \App\Entity\Hotel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Hotel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="hotel_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $hotel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\RoomValues", mappedBy="room")
     */
    private $roomValues;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roomValues = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param integer $description
     *
     * @return Room
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return integer
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
     * @return Room
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
     * Set hotel
     *
     * @param \App\Entity\Hotel $hotel
     *
     * @return Room
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

    /**
     * Add roomValue
     *
     * @param \App\Entity\RoomValues $roomValue
     *
     * @return Room
     */
    public function addRoomValue(\App\Entity\RoomValues $roomValue)
    {
        $this->roomValues[] = $roomValue;

        return $this;
    }

    /**
     * Remove roomValue
     *
     * @param \App\Entity\RoomValues $roomValue
     */
    public function removeRoomValue(\App\Entity\RoomValues $roomValue)
    {
        $this->roomValues->removeElement($roomValue);
    }

    /**
     * Get roomValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoomValues()
    {
        return $this->roomValues;
    }
}

