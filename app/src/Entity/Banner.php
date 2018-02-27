<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 *
 * @ORM\Table(name="banner", indexes={@ORM\Index(name="banner_page", columns={"page_id"})})
 * @ORM\Entity
 */
class Banner
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
     * @ORM\Column(name="name_clean", type="string", length=50, nullable=false)
     */
    private $nameClean;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=false)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=20, nullable=true)
     */
    private $position;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="datetime", nullable=false)
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="interval_init", type="datetime", nullable=true)
     */
    private $intervalInit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="interlval_end", type="datetime", nullable=true)
     */
    private $interlvalEnd;

    /**
     * @var \App\Entity\Page
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
    private $page;

    /**
     * @var ArrayCollection|BannerImageVideo[]
     *
     * @ORM\OneToMany(targetEntity="BannerImageVideo", mappedBy="banner")
     */
    private $resource;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->resource = new ArrayCollection();
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
     * Set nameClean
     *
     * @param string $nameClean
     *
     * @return Banner
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
     * Set description
     *
     * @param string $description
     *
     * @return Banner
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
     * Set link
     *
     * @param string $link
     *
     * @return Banner
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Banner
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Banner
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set intervalInit
     *
     * @param \DateTime $intervalInit
     *
     * @return Banner
     */
    public function setIntervalInit($intervalInit)
    {
        $this->intervalInit = $intervalInit;

        return $this;
    }

    /**
     * Get intervalInit
     *
     * @return \DateTime
     */
    public function getIntervalInit()
    {
        return $this->intervalInit;
    }

    /**
     * Set interlvalEnd
     *
     * @param \DateTime $interlvalEnd
     *
     * @return Banner
     */
    public function setInterlvalEnd($interlvalEnd)
    {
        $this->interlvalEnd = $interlvalEnd;

        return $this;
    }

    /**
     * Get interlvalEnd
     *
     * @return \DateTime
     */
    public function getInterlvalEnd()
    {
        return $this->interlvalEnd;
    }

    /**
     * Set page
     *
     * @param \App\Entity\Page $page
     *
     * @return Banner
     */
    public function setPage(\App\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \App\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return ArrayCollection|BannerImageVideo[]
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * @param ArrayCollection|BannerImageVideo[] $resource
     */
    public function setResource($resource) {
        $this->resource = $resource;
    }
}
