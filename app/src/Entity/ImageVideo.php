<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImageVideo
 *
 * @ORM\Table(name="image_video", indexes={@ORM\Index(name="image_video_idx_1", columns={"description", "name_generate", "name"}), @ORM\Index(name="image_video_banner", columns={"banner_id"}), @ORM\Index(name="image_video_gallery", columns={"gallery_id"}), @ORM\Index(name="image_video_page_details", columns={"page_details_id"})})
 * @ORM\Entity
 */
class ImageVideo
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
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="name_generate", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $nameGenerate;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $url;

    /**
     * @var \App\Entity\Banner
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Banner")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="banner_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $banner;

    /**
     * @var \App\Entity\Gallery
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Gallery")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gallery_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $gallery;

    /**
     * @var \App\Entity\PageDetails
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PageDetails")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_details_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $pageDetails;


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
     * Set name
     *
     * @param string $name
     *
     * @return ImageVideo
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
     * Set description
     *
     * @param string $description
     *
     * @return ImageVideo
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
     * @return ImageVideo
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
     * Set type
     *
     * @param string $type
     *
     * @return ImageVideo
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return ImageVideo
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
     * Set url
     *
     * @param string $url
     *
     * @return ImageVideo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set banner
     *
     * @param \App\Entity\Banner $banner
     *
     * @return ImageVideo
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
     * Set gallery
     *
     * @param \App\Entity\Gallery $gallery
     *
     * @return ImageVideo
     */
    public function setGallery(\App\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \App\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set pageDetails
     *
     * @param \App\Entity\PageDetails $pageDetails
     *
     * @return ImageVideo
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

