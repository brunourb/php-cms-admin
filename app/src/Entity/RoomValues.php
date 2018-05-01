<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomValues
 *
 * @ORM\Table(name="room_values", indexes={@ORM\Index(name="room_values_room", columns={"room_id"})})
 * @ORM\Entity
 */
class RoomValues
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
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=9, scale=2, nullable=false, unique=false)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="breakfast", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $breakfast;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lunch", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $lunch;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dinner", type="boolean", precision=0, scale=0, nullable=true, unique=false)
     */
    private $dinner;

    /**
     * @var \App\Entity\Room
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $room;


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
     * @return RoomValues
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
     * Set value
     *
     * @param string $value
     *
     * @return RoomValues
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
     * @return RoomValues
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
     * @return RoomValues
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
     * @return RoomValues
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
     * Set room
     *
     * @param \App\Entity\Room $room
     *
     * @return RoomValues
     */
    public function setRoom(\App\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \App\Entity\Room
     */
    public function getRoom()
    {
        return $this->room;
    }
}

