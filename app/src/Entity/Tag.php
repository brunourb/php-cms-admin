<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table(name="tag", indexes={@ORM\Index(name="tag_page", columns={"page_id"})})
 * @ORM\Entity
 */
class Tag
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
     * @ORM\Column(name="tag", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tag;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $enabled;

    /**
     * @var \App\Entity\Page
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $page;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\TagValues", mappedBy="tag")
     */
    private $values;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->values = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set tag
     *
     * @param string $tag
     *
     * @return Tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Tag
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
     * @return Tag
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
     * Add value
     *
     * @param \App\Entity\TagValues $value
     *
     * @return Tag
     */
    public function addValue(\App\Entity\TagValues $value)
    {
        $this->values[] = $value;

        return $this;
    }

    /**
     * Remove value
     *
     * @param \App\Entity\TagValues $value
     */
    public function removeValue(\App\Entity\TagValues $value)
    {
        $this->values->removeElement($value);
    }

    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getValues()
    {
        return $this->values;
    }
}

