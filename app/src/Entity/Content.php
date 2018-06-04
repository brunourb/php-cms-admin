<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="content", indexes={@ORM\Index(name="Table_38_image_video", columns={"image_video_id"})})
 * @ORM\Entity
 */
class Content
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
     * @ORM\Column(name="name_generate", type="string", length=255, nullable=false)
     */
    private $nameGenerate;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="string", length=100, nullable=true)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var \App\Entity\ImageVideo
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\ImageVideo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="image_video_id", referencedColumnName="id")
     * })
     */
    private $imageVideo;


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
     * Set nameGenerate
     *
     * @param string $nameGenerate
     *
     * @return Content
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
     * Set description
     *
     * @param string $description
     *
     * @return Content
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
     * Set title
     *
     * @param string $title
     *
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set caption
     *
     * @param string $caption
     *
     * @return Content
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    /**
     * Get caption
     *
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Content
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
     * Set imageVideo
     *
     * @param \App\Entity\ImageVideo $imageVideo
     *
     * @return Content
     */
    public function setImageVideo(\App\Entity\ImageVideo $imageVideo = null)
    {
        $this->imageVideo = $imageVideo;

        return $this;
    }

    /**
     * Get imageVideo
     *
     * @return \App\Entity\ImageVideo
     */
    public function getImageVideo()
    {
        return $this->imageVideo;
    }
}
