<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gallery
 *
 * @ORM\Table(name="gallery", indexes={@ORM\Index(name="gallery_banner", columns={"banner_id"}), @ORM\Index(name="gallery_page_details", columns={"page_details_id"}), @ORM\Index(name="gallery_room", columns={"room_id"})})
 * @ORM\Entity
 */
class Gallery
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
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled;

    /**
     * @var \App\Entity\Banner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Banner")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="banner_id", referencedColumnName="id")
     * })
     */
    private $banner;

    /**
     * @var \App\Entity\PageDetails
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PageDetails")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_details_id", referencedColumnName="id")
     * })
     */
    private $pageDetails;

    /**
     * @var \App\Entity\Room
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
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
     * @return Gallery
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
     * @return Gallery
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
     * Set banner
     *
     * @param \App\Entity\Banner $banner
     *
     * @return Gallery
     */
    public function setBanner(\App\Entity\Banner $banner = null)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return \App\Entity\Banner
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set pageDetails
     *
     * @param \App\Entity\PageDetails $pageDetails
     *
     * @return Gallery
     */
    public function setPageDetails(\App\Entity\PageDetails $pageDetails = null)
    {
        $this->pageDetails = $pageDetails;

        return $this;
    }

    /**
     * Get pageDetails
     *
     * @return \App\Entity\PageDetails
     */
    public function getPageDetails()
    {
        return $this->pageDetails;
    }

    /**
     * Set room
     *
     * @param \App\Entity\Room $room
     *
     * @return Gallery
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
