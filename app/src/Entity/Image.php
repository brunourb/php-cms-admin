<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image", indexes={@ORM\Index(name="image_page_details", columns={"page_details_id"})})
 * @ORM\Entity
 */
class Image
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
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name_generate", type="string", length=255, nullable=true)
     */
    private $nameGenerate;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Image
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
     * Set description
     *
     * @param string $description
     *
     * @return Image
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
     * Set nameGenerate
     *
     * @param string $nameGenerate
     *
     * @return Image
     */
    public function setNameGenerate($nameGenerate)
    {
        $this->nameGenerate = $nameGenerate;

        return $this;
    }

    /**
     * Get nameGenerate
     *
     * @return string
     */
    public function getNameGenerate()
    {
        return $this->nameGenerate;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Image
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Image
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Image
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
     * Set pageDetails
     *
     * @param \App\Entity\PageDetails $pageDetails
     *
     * @return Image
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
}
