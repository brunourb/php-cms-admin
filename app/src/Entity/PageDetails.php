<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PageDetails
 *
 * @ORM\Table(name="page_details", indexes={@ORM\Index(name="hotels_details_hotels", columns={"page_id"})})
 * @ORM\Entity
 */
class PageDetails
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
     * @ORM\Column(name="description", type="string", length=45, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

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
     * @var ArrayCollection|Image[]
     *
     * @ORM\OneToMany(targetEntity="Image", mappedBy="pageDetails")
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new ArrayCollection();
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
     * @return PageDetails
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
     * @return PageDetails
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return PageDetails
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
     * Set page
     *
     * @param \App\Entity\Page $page
     *
     * @return PageDetails
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
     * @return Image[]|ArrayCollection
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * @param Image[]|ArrayCollection $images
     */
    public function setImages($images) {
        $this->images = $images;
    }
}
