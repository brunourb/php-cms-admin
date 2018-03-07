<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BannerImageVideoResource
 *
 * @ORM\Table(name="banner_image", indexes={@ORM\Index(name="banner_image_banner", columns={"banner_id"})})
 * @ORM\Entity
 */
class BannerImageVideo
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=20, nullable=true)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_init", type="date", nullable=true)
     */
    private $dateInit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

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
     * @return BannerImageVideo
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
     * Set location
     *
     * @param string $location
     *
     * @return BannerImageVideo
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set priority
     *
     * @param string $priority
     *
     * @return BannerImageVideo
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return BannerImageVideo
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateInit
     *
     * @param \DateTime $dateInit
     *
     * @return BannerImageVideo
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
     * @param \DateTime $dateEnd
     *
     * @return BannerImageVideo
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set banner
     *
     * @param \App\Entity\Banner $banner
     *
     * @return BannerImageVideo
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
}
